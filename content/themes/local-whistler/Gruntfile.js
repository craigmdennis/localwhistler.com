// Generated on 2014-03-14 using generator-webapp 0.4.8
'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to recursively match all subfolders:
// 'test/spec/**/*.js'

module.exports = function (grunt) {

  // Load grunt tasks automatically
  require('load-grunt-tasks')(grunt);

  // Time how long tasks take. Can help when optimizing build times
  require('time-grunt')(grunt);

  // Turn on the stack trace by default
  grunt.option('stack', true);

  // Define the configuration for all the tasks
  grunt.initConfig({

    // Read the contents of the package file
    pkg: grunt.file.readJSON('package.json'),

    // Project settings
    config: {
      base: 'content/themes/local-whistler',
      tmp: '.tmp',

      // Configurable paths
      app: {
        base: 'app',
        bower: '<%= config.app.base %>/bower_components',
        scripts: '<%= config.app.base %>/scripts',
        styles: '<%= config.app.base %>/styles',
        templates: '<%= config.app.base %>/templates',
        partials: '<%= config.app.base %>/partials',
        img: '<%= config.app.base %>/images'
      },

      dist: {
        scripts: 'scripts',
        img: 'images'
      },

      local: 'http://localwhistler.local',
      staging: 'http://lw-dev.simplebitdeign.com',
      live: 'http://localwhistler.com',

      wpBanner: '/*\n' +
                'Theme Name: <%= pkg.title %>\n'+
                'Author: <%= pkg.author %>\n' +
                'Author URI: <%= pkg.authorURI %>\n' +
                'Description: <%= pkg.description %>\n' +
                '*/\n'

    },

    // Watches files for changes and runs tasks based on the changed files
    watch: {
      options: {
        spawn: true,
        interrupt: true,
        livereloadOnError: false
      },

      coffee: {
        files: ['<%= config.app.scripts %>/{,*/}*.{coffee,litcoffee,coffee.md}'],
        tasks: ['coffee', 'jshint:server', 'concat:server'],
      },
      js: {
        files: ['<%= config.app.scripts %>/{,*/}*.js'],
        tasks: ['newer:copy:server', 'jshint:server', 'concat:server']
      },
      gruntfile: {
        files: ['Gruntfile.js'],
        tasks: ['jshint:gruntfile', 'default'],
      },
      sass: {
        files: ['<%= config.app.styles %>/{,*/}*.{scss,sass}'],
        tasks: ['sass', 'autoprefixer', 'cssmin']
      },
      styles: {
        files: ['<%= config.app.styles %>/{,*/}*.css'],
        tasks: ['copy:all']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          '{,*/}*.php',
          '<%= config.tmp %>/styles/{,*/}*.css',
          '<%= config.tmp %>/scripts/{,*/}*.js',
          '<%= config.app %>/images/{,*/}*.*'
        ]
      }
    },

    // The actual grunt server settings
    connect: {
      dist: {
        port: 9000,
        hostname: '*',
        open: '<%= config.local %>'
      }
    },

    // Empties folders to start fresh
    clean: {
      all: {
        files: [{
          dot: true,
          src: [
            '<%= config.tmp %>',
            '<%= config.dist.img %>/*',
            '<%= config.dist.scripts %>/*',
            'style.css'
          ]
        }]
      }
    },

    // Make sure code styles are up to par and there are no obvious mistakes
    jshint: {
      options: {
        jshintrc: '.jshintrc',
        reporter: require('jshint-stylish')
      },

      // Hint the gruntfile
      gruntfile: {
        src: 'Gruntfile.js'
      },

      // Hint files but don't fail the task
      server: {
        options: {
          force: true
        },
        src: [
          '<%= config.tmp %>/scripts/*.js',
          '!<%= config.tmp %>/scripts/vendor/*.js'
        ]
      },

      // Use the same source as server but fail the task
      dist: {
        src: '<%= jshint.server.src %>'
      }
    },

    // Compiles CoffeeScript to JavaScript
    coffee: {
      options: {
        bare: true
      },
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.app.scripts %>/',
          src: '{,*/}*.{coffee,litcoffee,coffee.md}',
          dest: '<%= config.tmp %>/scripts',
          ext: '.js'
        }]
      },
    },

    // Compiles Sass to CSS and generates necessary files if requested
    sass: {
      options: {
        style: 'expanded',
        sourcemap: false,
        quiet: true,
        require: 'susy'
      },
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.app.styles %>/',
          src: '{,*/}*.scss',
          dest: '.tmp/styles',
          ext: '.css'
        }]
      }
    },

    // Add vendor prefixed styles
    autoprefixer: {
      options: {
        browsers: ['last 2 versions']
      },
      dist: {
        files: [{
          expand: true,
          cwd: '.tmp',
          src: '.tmp/styles/{,*/}*.css',
          dest: '.tmp/styles',
          ext: '.css'
        }]
      }
    },

    concat: {
      options: {
        stripBanners: true
      },
      server: {
        src: '<%= config.tmp %>/scripts/{,*/}*.js',
        dest: '<%= config.dist.scripts %>/script.js'
      },
      dist: {
        src: '<%= config.tmp %>/scripts/{,*/}*.js',
        dest: '<%= config.tmp %>/scripts/concat/script.js'
      }
    },

    uglify: {
      options: {
        compress: true,
        mangle: true,
        sourceMap: true,
      },
      all: {
        src: '<%= concat.dist.dest %>',
        dest: '<%= config.dist.scripts %>/script.js'
      }
    },

    cssmin: {
      options: {
        banner: '<%= config.wpBanner %>',
        compress: true,
        keepSpecialComments: false,
        report: 'min'
      },
      all: {
        src: '<%= config.tmp %>/styles/{,*/}*.css',
        dest: 'style.css'
      }
    },

    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.app.img %>/',
          src: '{,*/}*.{gif,jpeg,jpg,png}',
          dest: '<%= config.dist.img %>'
        },
        {
          expand: true,
          cwd: '<%= config.app.bower %>/bxslider-4/images/',
          src: '{,*/}*.{gif,jpeg,jpg,png}',
          dest: '<%= config.dist.img %>'
        }]
      }
    },

    // Copies remaining files to places other tasks can use
    copy: {
      all: {
        files: [
          {
            expand: true,
            dot: true,
            cwd: '<%= config.app.base %>',
            dest: '/',
            src: [
              '*.{ico,png,txt,svg,php,md}',
              '.htaccess',
              'README'
            ]
          }
        ]
      },

      server: {
        files: [
          {
            // Copy any js files to the temp folder
            expand: true,
            dot: true,
            cwd: '<%= config.app.scripts %>/',
            dest: '<%= config.tmp %>/scripts',
            src: '{,*/}*.js'
          },
          {
            // Copy any css files to the temp folder
            expand: true,
            dot: true,
            cwd: '<%= config.app.styles %>/',
            dest: '<%= config.tmp %>',
            src: '{,*/}*.css'
          },
          {
            expand: true,
            cwd: '<%= config.app.bower %>/bxslider-4/images',
            src: '{,*/}*.{gif,jpeg,jpg,png}',
            dest: '<%= config.dist.img %>'
          },
          {
            // Copy BX Slider JS to the .tmp directory
            src: '<%= config.app.bower %>/bxslider-4/jquery.bxslider.js',
            dest: '<%= config.tmp %>/scripts/jquery.bxslider.js'
          },
          {
            // Copy BX Slider CSS to the .tmp directory
            src: '<%= config.app.bower %>/bxslider-4/jquery.bxslider.css',
            dest: '<%= config.tmp %>/styles/jquery.bxslider.css'
          },
          {
            // Copy BX Slider Images to the .tmp directry
            src: '<%= config.app.bower %>/bxslider-4/images/',
            dest: '<%= config.dist.img %>'
          },
          {
            // Copy tinysort to the .tmp directry
            src: '<%= config.app.bower %>/tinysort/dist/jquery.tinysort.js',
            dest: '<%= config.tmp %>/scripts/jquery.tinysort.js'
          },
          {
            // Copy BX Slider CSS to the .tmp directory
            src: '<%= config.app.bower %>/normalize-css/normalize.css',
            dest: '<%= config.tmp %>/styles/normalize.css'
          },
        ]
      },

      dist: {
        files: [
          {
            // Copy remaining images and fonts directly to the dist folder
            expand: true,
            dot: true,
            cwd: '<%= config.app.base %>',
            dest: '',
            src: [
              'images/{,*/}*.{webp,svg}',
              'fonts/{,*/}*.*'
            ]
          },
          {
            // Copy jQuery as self-hosted fallback
            src: '<%= config.bower %>/jquery/dist/jquery.min.js',
            dest: '<%= config.dist.scripts %>/vendor/jquery.min.js'
          }

        ]
      }
    },

    // Generates a custom Modernizr build that includes only the tests you
    // reference in your app
    modernizr: {
      dist: {
        devFile: '<%= config.app.bower %>/modernizr/modernizr.js',
        outputFile: '<%= config.dist.scripts %>/modernizr-custom.js',
        files: {
          src: [
            '<%= config.tmp %>/scripts/concat/script.js',
            '<%= config.tmp %>/styles/{,*/}*.css',
            '!<%= config.tmp %>/scripts/vendor/*'
          ]
        },
        matchCommunityTests: true,
        uglify: true,
        extra: {
          shiv: false,
          load: false
        }
      }
    },

    bump: {
      options: {
        files: ['package.json', 'bower.json'],
        push: true,
        pushTo: 'origin',
        createTag: true,
        tagName: 'v%VERSION%',
        tagMessage: 'Version %VERSION%',
        commitFiles: ['<%= bump.options.files %>', 'CHANGELOG.md'],
        commitMessage: 'Bumped version to v%VERSION%'
      }
    },

    changelog: {
      options: {
        editor: 'atom -w'
      }
    },

    // Wordpress management with Grunt
    // wordpressdeploy: {
    //   options: {
    //     backup_dir: 'backups/',
    //   },
    //   local: {
    //     'title': 'Local',
    //     'database': 'localwhistler_wp',
    //     'user': 'localwhistler',
    //     'pass': '7eTPHyBWnbAYYQj7',
    //     'host': '127.0.0.1',
    //     'url': 'http://localwhistler.local',
    //     'path': '/Users/craigmdennis/Sites/localwhistler.com'
    //   },
    //   staging: {
    //     'title': 'Staging',
    //     'database': 'db152547_localwhistler_dev',
    //     'user': 'db152547_dev',
    //     'pass': '4P999>H3i)3#3747',
    //     'host': 'external-db.s152547.gridserver.com',
    //     'url': 'http://lw-dev.simplebitdesign.com',
    //     'path': '/home/152547/users/.home/domains/lw-dev.simplebitdesign.com/',
    //     'ssh_host': 'simplebitdesign.com@s152547.gridserver.com'
    //   },
    //   production: {
    //
    //   }
    // },

    // Run some tasks in parallel to speed up build process
    concurrent: {
      options: {
        logConcurrentOutput: true,
        limit: 5
      },
      server: [
        'sass',
        'newer:coffee'
      ],
      dist: [
        'sass',
        'coffee',
        'imagemin'
      ]
    }
  });

  grunt.event.on('watch', function(action, filepath, target) {
    grunt.log.writeln(target + ': ' + filepath + ' has ' + action);
  });

  grunt.registerTask('default', [
    'clean',
    'concurrent:server',
    'copy:server',
    'autoprefixer',
    'concat:server',
    'cssmin',
    'copy:dist',
  ]);

  grunt.registerTask('serve', [
    'default',
    'connect',
    'watch'
  ]);

  grunt.registerTask('build', [
    'clean',
    'concurrent:dist',
    'jshint',
    'copy:server',
    'autoprefixer',
    'concat:dist',
    'modernizr',
    'cssmin',
    'copy:dist',
    'uglify'
  ]);

};
