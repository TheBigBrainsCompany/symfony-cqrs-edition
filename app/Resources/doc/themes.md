# The Big Brains Company - Symfony Standard CQRS


## Creating a custom theme

### Theme directory structure

First of all, the theme directory structure must be create in
`src/Acme/Demo/Ui/WebBundle/Resources/themes/my_theme`

The theme directory **must strictly** match the following structure:

```
my_theme/
    assets/
        images/
        javascript/
        less/
    views/
    grunt.json
```

All directories must exist even if they are empty!

### Configuring assets in grunt.json

Next, you need to tell the system what assets it needs to handle.
In order to do that you must complete your `grunt.json` config file with the following structure:

```json
{
    "javascript": [
        "web/vendor/jquery/jquery.js",
    ],
    "css": [
        "vendor/phpygments/phpygments/src/PHPygments/styles/default.css",
        "var/assets/build/css/all.css"
    ],
    "watch": {
        "less_css": [
            "less/all.less",
            "less/style.less",
            "less/variables.less",
        ],
        "javascript": [
            "javascript/app.js"
        ]
    }
}
```

Once again, **every property must exist in the object**, even if they are empty objets or arrays.

* `javascript`: here you need to list all the javascript files (from vendor + your own) that you want to be compiled into the concatenated javascript file.
* `css`: same as javascript but for less and/or css files
* `watch`: here you can specify for what changes the task `grunt watch` has to automatically recompile the output file

#### Important note

In the example you can see a "special" path at `var/assets/build/css/all.css`.
Grunt will build less files in `var/assets/build/css` directory just before concatenating them.
Each less file will be compiled into a css file with the exact same name (except for the extension).
So, you have to specify here your "main" stylesheet using the name that Grunt will generate.

**In example**: if you have a `all.less` file that imports all your other less sheet, then you will have to specify `var/assets/build/css/all.css`.

We strongly recommend that you make use of `less` import feature instead of enumerating all your css output files in your `grunt.json` configuration file.


### Overriding project templates

You can override all or only a part of the `default` theme templates.
If the system can't find the needed template in your custom theme, it will try to load it from the `default` theme, which acts as a fallback theme.

To override a template, just recreate the exact same template path and name.
You can then modify your custom template at will.

### Registering and activating your theme

For registering your theme into the system, you need to add it in the theme list and activate it in your `app/config/parameters.yml` file,
just like the following:

```yaml
themes: ['default', 'my_theme']
active_theme: my_theme
```

Finally, in your `config.json` file, set your custom theme as the `active_theme`:

```json
{
    "active_theme": "my_theme"
}
```
