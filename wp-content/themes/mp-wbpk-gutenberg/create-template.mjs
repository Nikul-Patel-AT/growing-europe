import inquirer from 'inquirer'
import fs from 'fs'

const questions = [
    {
        type: 'list',
        name: 'type',
        message: 'Select type',
        choices: [
            'template',
            'single',
            'archive',
        ]
    },
    {
        type: 'input',
        name: 'slug',
        message: "Enter slug (dash seperated)"
    },
    {
        type: 'input',
        name: 'name',
        message: "Enter name"
    }
]

inquirer.prompt(questions)
    .then((answers) => {
        let page_data
        const slug_lowercase = answers.slug.toLowerCase()
        if (answers.type === 'template') {

            page_data = '<?php' +
                '\n' +
                '\n' +
                '/** Template name: ' + answers.name + ' */' +
                '\n' +
                '\n' +
                'get_header(); ?>' +
                '\n' +
                '\n' +
                '<?php the_content(); ?>' +
                '\n' +
                '\n' +
                '<?php get_footer();'

        } else {
            page_data = '<?php get_header(); ?>' +
                '\n' +
                '\n' +
                '<?php the_content(); ?>' +
                '\n' +
                '\n' +
                '<?php get_footer();'

        }

        const full_name = answers.type + '-' + slug_lowercase

        const scss_data = '@import "core/_common";'
        const js_data = 'import \'../scss/' + full_name + '.scss\''

        fs.writeFile(full_name + '.php', page_data, function (err) {
            if (err) throw err;
        });
        fs.writeFile('src/scss/' + full_name + '.scss', scss_data, function (err) {
            if (err) throw err;
        });
        fs.writeFile('src/js/' + full_name + '.js', js_data, function (err) {
            if (err) throw err;
        });

        let data = fs.readFileSync('webpack-entry.json', 'utf8')
        data = JSON.parse(data)
        data[answers.type + '-' + slug_lowercase] = './src/js/' + answers.type + '-' + slug_lowercase +'.js'
        fs.writeFileSync('webpack-entry.json', JSON.stringify(data, null, 2));
    });