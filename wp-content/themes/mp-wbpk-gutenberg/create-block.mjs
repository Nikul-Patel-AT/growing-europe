import inquirer from 'inquirer'
import fs from 'fs'

const questions = [
    {
        type: 'input',
        name: 'slug',
        message: "Enter slug (dash seperated)"
    },
    {
        type: 'input',
        name: 'name',
        message: "Enter name"
    },
    {
        type: 'input',
        name: 'description',
        message: "Description"
    },
    {
        type: 'input',
        name: 'dashicon',
        message: "Dashicon",
        default: 'block-default'
    },
]

const snakeToCamel = str =>
    str.toLowerCase().replace(/([-_][a-z])/g, group =>
        group
            .toUpperCase()
            .replace('-', '')
            .replace('_', '')
    );

inquirer.prompt(questions)
    .then((answers) => {
        const slug_lowercase = answers.slug.toLowerCase();
        const template_data = '<?php\n' +
            '\n' +
            '/**\n' +
            ' * ' + answers.name + ' Block Template.\n' +
            ' *\n' +
            ' * @param   array $block The block settings and attributes.\n' +
            ' * @param   string $content The block inner HTML (empty).\n' +
            ' * @param   bool $is_preview True during AJAX preview.\n' +
            ' * @param   (int|string) $post_id The post ID this block is saved to.\n' +
            ' */\n' +
            '\n' +
            '$block = $args;' +
            '\n' +
            '\n' +
            '// Create id attribute allowing for custom "anchor" value.\n' +
            '$id = \'' + slug_lowercase + '-\' . $block[\'id\'];\n' +
            'if( !empty($block[\'anchor\']) ) {\n' +
            '    $id = $block[\'anchor\'];\n' +
            '}\n' +
            '\n' +
            '// Create class attribute allowing for custom "className" and "align" values.\n' +
            '$className = \'' + slug_lowercase + '\';\n' +
            'if( !empty($block[\'className\']) ) {\n' +
            '    $className .= \' \' . $block[\'className\'];\n' +
            '}\n' +
            '\n' +
            '?>\n' +
            '\n' +
            '<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">\n' +
            '    \n' +
            '</section>\n' +
            '\n' +
            '<?php printf( "<script>window.dispatchEvent( new Event(\'acf/loaded/' + slug_lowercase + '\'));</script>" );'
        const scss_data = ''
        const scss_data_editor = '.editor-styles-wrapper {\n' +
            '  @import "src/scss/core/_common";\n' +
            '  @import "_' + slug_lowercase + '";\n' +
            '  padding: 0;\n' +
            '}'
        const js_data = "import './_" + slug_lowercase + ".scss'\n" +
            "\n" +
            "const " + snakeToCamel(slug_lowercase) + " = function() {\n" +
            "\n" +
            "};\n" +
            "\n" +
            "document.addEventListener('DOMContentLoaded', function(){\n" +
            "    " + snakeToCamel(slug_lowercase) + "()\n" +
            "}, false);\n" +
            "\n" +
            "window.addEventListener('acf/loaded/" + slug_lowercase + "', function (e) {\n" +
            "    " + snakeToCamel(slug_lowercase) + "()\n" +
            "});"
        const js_data_editor = "import './" + slug_lowercase + "'\n" +
            "import './_" + slug_lowercase + "-editor.scss'"

        fs.mkdirSync('template-parts/blocks/' + slug_lowercase + '/', { recursive: true })
        fs.writeFile('template-parts/blocks/' + slug_lowercase + '/' + slug_lowercase + '.php', template_data, function (err) {
            if (err) throw err;
        });
        fs.writeFile('template-parts/blocks/' + slug_lowercase + '/_' + slug_lowercase + '.scss', scss_data, function (err) {
            if (err) throw err;
        });
        fs.writeFile('template-parts/blocks/' + slug_lowercase + '/_' + slug_lowercase + '-editor.scss', scss_data_editor, function (err) {
            if (err) throw err;
        });
        fs.writeFile('template-parts/blocks/' + slug_lowercase + '/' + slug_lowercase + '.js', js_data, function (err) {
            if (err) throw err;
        });
        fs.writeFile('template-parts/blocks/' + slug_lowercase + '/' + slug_lowercase + '-editor.js', js_data_editor, function (err) {
            if (err) throw err;
        });

        let data = fs.readFileSync('acf-blocks.json', 'utf8')
        data = JSON.parse(data)

        data[slug_lowercase] = {
            'slug': slug_lowercase,
            'name': answers.name,
            'description': answers.description,
            'dashicon': answers.dashicon,
        };

        fs.writeFileSync('acf-blocks.json', JSON.stringify(data, null, 2));

        let data_entry = fs.readFileSync('webpack-entry.json', 'utf8')
        data_entry = JSON.parse(data_entry)
        data_entry[slug_lowercase] = './template-parts/blocks/' + slug_lowercase + '/' + slug_lowercase +'.js'
        data_entry[slug_lowercase + '-editor'] = './template-parts/blocks/' + slug_lowercase + '/' + slug_lowercase +'-editor.js'
        fs.writeFileSync('webpack-entry.json', JSON.stringify(data_entry, null, 2));
    });