module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        options : {

            base : 'assets',

            publish : 'public/builds',

            clean : {
                all : [
                    '<%= options.css.concat %>',
                    '<%= options.css.min %>',
                    '<%= options.js.min %>',
                    '<%= options.js.concat %>',
                ],
                concat: [
                    '<%= options.css.concat %>',
                    '<%= options.js.concat %>'
                ]
            },

            css : {
                base : '<%= options.base %>/css',
                files : [
                    '<%= options.css.base %>/reset.css',
                    '<%= options.css.base %>/default.css',
                    '<%= options.css.base %>/pure/pure.min.css',
                    '<%= options.css.base %>/front.css',
                ],
                concat : '<%= options.css.base %>/concat.css',
                min : '<%= options.publish %>/css/style.min.css'
            },

            js : {
                base : '<%= options.base %>/js',
                files : [
                    '<%= options.js.base %>/jquery.js'
                ],
                concat : '<%= options.js.base %>/concat.js',
                min : '<%= options.publish %>/js/app.min.js'
            }

        },

        clean: {
            all: {
                src: '<%= options.clean.all %>'
            },
            concat: {
                src: '<%= options.clean.concat %>'
            }
        },

        jshint: {
            all: ['Gruntfile.js']
        },

        concat: {
            css : {
                files: {
                    '<%= options.css.concat %>' : '<%= options.css.files %>'
                }
            },
            js : {
                options: {
                    block: true,
                    line: true,
                    stripBanners: true
                },
                files: {
                    '<%= options.js.concat %>' : '<%= options.js.files %>',
                }
            }
        },

        cssmin: {
            minify: {
                src: '<%= options.css.concat %>',
                dest: '<%= options.css.min %>'
            }
        },

        uglify: {
            options: {
                mangle : false,
                //beautify: true,
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n'
            },
            build: {
                src: '<%= options.js.concat %>',
                dest: '<%= options.js.min %>'
            }
        }

    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');

    // Default task(s).
    grunt.registerTask('default', ['clean:all','jshint:all','concat','cssmin','uglify','clean:concat']);

    // Production
    // grunt.registerTask('default', ['clean:all','concat','cssmin','uglify','clean:concat']);

};