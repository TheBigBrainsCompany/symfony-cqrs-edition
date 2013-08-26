module.exports = function (grunt) {
    grunt.loadNpmTasks('grunt-symlink');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    var globalConfig = grunt.file.readJSON('config.json'),
        themesPath = globalConfig.themes_path,
        theme = globalConfig.active_theme,
        themePath = themesPath + '/' + theme,
        themeConfig = grunt.file.readJSON(themePath + '/grunt.json'),
        publicPath = 'web/themes/' + theme,
        watchFiles = {"less_css": [], "javascript": []},
        watchConfig = {},
        gruntConfig;

    themeConfig.watch.less_css.forEach(function(file) {
        watchFiles.less_css.push(themePath + '/assets/' + file);
    });

    themeConfig.watch.javascript.forEach(function(file) {
        watchFiles.javascript.push(themePath + '/assets/' + file);
    });

    // Project configuration.
    gruntConfig = {
        pkg: grunt.file.readJSON('package.json'),

        less: {
            app: {
                expand: true,
                cwd:    themePath + '/assets/less',
                src:    '*',
                dest:   'var/assets/build/css',
                ext:    '.css'
            }
        },
        symlink: {
            theme_images: {
                dest: publicPath + '/images',
                relativeSrc: '../../../' + themePath + '/assets/images',
                options: {type: 'dir'}
            },
            theme_fonts: {
                dest: publicPath + '/fonts',
                relativeSrc: '../../../' + themePath + '/assets/fonts',
                options: {type: 'dir'}
            }
        },
        copy: {
            theme_images: {
                expand: true,
                cwd: themePath + '/assets/images',
                src: '**',
                dest: publicPath + '/images/'
            },
            theme_fonts: {
                expand: true,
                cwd: themePath + '/assets/fonts',
                src: '**',
                dest: publicPath + '/fonts/'
            }
        },
        concat: {
            javascript: {
                src: themeConfig.javascript,
                dest: publicPath + '/javascript/main.js'
            },
            css: {
                src: themeConfig.css,
                dest: publicPath + '/css/style.min.css'
            }
        },
        jshint: {
            options: {
                curly: true,
                eqeqeq: true,
                eqnull: true,
                browser: true,
                undef: true,
                unused: true,
                bitwise: true,
                camelcase: true,
                forin: true,
                immed: true,
                latedef: true,
                newcap: true,
                quotmark: 'single',
                strict: true,
                maxparams: 4,
                maxdepth: 2,
                maxcomplexity: 5,
                globals: {
                    'jQuery': true,
                    '$': true,
                    '_': true,
                    'Mustache': true
                }
            },
            dist: {
                src: [themePath + '/assets/javascript/*.js']
            }
        }
    };


    // Uglify task dynamic config
    if (themeConfig.javascript.length) {
        var uglifyConfig = {dist: {files: {}}};
        uglifyConfig.dist.files[publicPath + '/javascript/main.min.js'] = [
            publicPath + '/javascript/main.js'
        ];
        gruntConfig['uglify'] = uglifyConfig;
    }

    // Watch task dynamic config
    if (watchFiles.hasOwnProperty('less_css') && watchFiles['less_css'].length) {
        watchConfig['css'] = {
            files: watchFiles.less_css,
            tasks: ['css']
        };
    }
    if (watchFiles.hasOwnProperty('javascript') && watchFiles['javascript'].length) {
        watchConfig['css'] = {
            files: watchFiles.javascript,
            tasks: ['javascript-dev']
        };
    }
    if (watchConfig) {
        gruntConfig['watch'] = watchConfig;
    }

    grunt.config.init(gruntConfig);

    // Default task(s).
    grunt.registerTask('css', ['less', 'concat:css']);
    grunt.registerTask('javascript', ['jshint', 'concat:javascript', 'uglify']);
    grunt.registerTask('javascript-dev', ['jshint', 'concat:javascript']);

    grunt.registerTask('default', ['copy', 'css', 'javascript']);
    grunt.registerTask('dev', ['copy', 'css', 'javascript-dev'])

};
