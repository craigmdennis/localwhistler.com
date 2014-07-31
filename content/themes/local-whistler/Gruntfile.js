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

      wpBanner: '/*' +
                'Theme Name: <%= pkg.title %> ' +
                'Author: <%= pkg.author %> ' +
                'Author URI: <%= pkg.authorURI %> ' +
                'Description: <%= pkg.description %> ' +
              '*/',

    },

    // Watches files for changes and runs tasks based on the changed files
    watch: {
      options: {
        spawn: false,
        interrupt: true,
        // livereloadOnError: false
      },
      // jadeTemplates: {
      //   files: ['<%= config.app.templates %>/*.jade', '<%= config.app.partials %>/*.jade'],
      //   tasks: ['jadephp:dist']
      // },
      coffee: {
        files: ['<%= config.app.scripts %>/{,*/}*.{coffee,litcoffee,coffee.md}'],
        tasks: ['coffee', 'jshint:server'],
      },
      sassConfig: {
        files: ['config.rb'],
        tasks: ['compass:server']
      },
      js: {
        files: ['<%= config.app.scripts %>/{,*/}*.js'],
        tasks: ['copy:server', 'jshint:server']
      },
      gruntfile: {
        files: ['Gruntfile.js'],
        tasks: ['jshint:gruntfile', 'default'],
        options: {
          livereload: true
        }
      },
      compass: {
        files: ['<%= config.app.styles %>/{,*/}*.{scss,sass}'],
        tasks: ['compass:server', 'autoprefixer']
      },
      styles: {
        files: ['<%= config.app.styles %>/{,*/}*.css'],
        tasks: ['copy:all', 'autoprefixer']
      },
      php: {
        files: ['{,*/}*.php'],
        options: {
          livereload: true
        }
      },
      tmp: {
        files: [
          '<%= config.tmp %>/styles/{,*/}*.css',
          '<%= config.tmp %>/scripts/{,*/}*.js',
          '<%= config.app %>/{,*/}*.{gif,svg,jpg,png,webp}'
        ],
        options: {
          livereload: true
        }
      }
    },

    // The actual grunt server settings
    connect: {
      options: {
        port: 9000,
        livereload: 35729,
        hostname: '0.0.0.0'
      },
      livereload: {
        options: {
          open: '<%= config.local %>'
        }
      },
      dist: {
        options: {
          open: '<%= config.local %>',
          livereload: false
        }
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
        src: '<%= config.tmp %>/scripts/{,*/}.js'
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
    compass: {
      options: {
        config: 'config.rb'
      },
      dist: {
        options: {
          debugInfo: false,
          sourcemap: true
        }
      },
      server: {
        options: {
          debugInfo: true
        }
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
          cwd: '<%= config.tmp %>/styles/',
          src: '{,*/}*.css',
          dest: '<%= config.tmp %>/styles/'
        }]
      }
    },

    // Automatically inject Bower components into the HTML file
    bowerInstall: {
      app: {
        src: ['<%= config.app.partials %>/{,*/}*.jade'],
        ignorePath: '<%= config.app.base %>/',
        exclude: ['<%= config.app.bower %>/bootstrap-sass/vendor/assets/javascripts/bootstrap.js', ],
      },
      sass: {
        src: ['<%= config.app.styles %>/{,*/}*.{scss,sass}'],
        ignorePath: '<%= config.app.base %>/bower_components/'
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
        keepSpecialComments: false
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
            // Copy BX Slider CSS to the .tmp directory
            src: '<%= config.app.bower %>/bxslider-4/jquery.bxslider.js',
            dest: '<%= config.tmp %>/scripts/jquery.bxslider.js'
          },
          {
            // Copy BX Slider CSS to the .tmp directory
            src: '<%= config.app.bower %>/bxslider-4/jquery.bxslider.css',
            dest: '<%= config.tmp %>/styles/jquery.bxslider.css'
          },
          {
            // Copy bxslinder CSS to the .tmp directry
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
            // Copy all optimised images and fonts directly to the dist folder
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
            // Copy Sass Map
            src: '.tmp/style.css.map',
            dest: 'style.css.map',
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
      devFile: '<%= config.app.bower %>/modernizr/modernizr.js',
      outputFile: '<%= config.dist.scripts %>/modernizr-custom.js',
      files: [
        '<%= config.tmp %>/scripts/concat/script.js',
        '<%= config.tmp %>/styles/{,*/}*.css',
        '!<%= config.tmp %>/scripts/vendor/*'
      ],
      uglify: true,
      extra: {
        shiv: false,
        load: false
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

    // Run some tasks in parallel to speed up build process
    concurrent: {
      options: {
        logConcurrentOutput: true,
        limit: 5
      },
      server: [
        'compass:server',
        'newer:coffee',
      ],
      dist: [
        'compass:dist',
        'coffee',
        'imagemin'
      ]
    }
  });

  grunt.registerTask('default', function () {

    grunt.task.run([
      'clean',
      'concurrent:server',
      'copy:server',
      'autoprefixer',
      'concat:server',
      'cssmin',
      'copy:dist',
    ]);
  });

  grunt.registerTask('serve', function () {

    grunt.task.run([
      'default',
      'connect:livereload',
      'watch'
    ]);
  });

  grunt.registerTask('server', function (target) {
    grunt.log.warn('The `server` task has been deprecated. Use `grunt serve` to start a server.');
    grunt.task.run([target ? ('serve:' + target) : 'serve']);
  });

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
    'uglify',
    'connect:dist'
  ]);

};
