/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration below.
    grunticon: {
      icons: {
        options: {
          svgo: true,
          src: "../source/svgs/",
          dest: "../source/icons/",
          datasvgcss: "icons.data.svg.scss",
          datapngcss: "icons.data.png.scss",
          urlpngcss: "icons.fallback.scss"
        }
      }
    },
    sass: {
      build: {
        files: {
          '../style.css': ['../source/css/compile.svg.scss'],
          '../style.data.png.css': ['../source/css/compile.png.scss'],
          '../style.fallback.css': ['../source/css/compile.fallback.scss']
        }
      }
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        // Add any javascript files in the main JS directory or in the vendor directory to the compiled file
        src: ['../source/js/vendor/*.js','../source/js/*.js'],
        dest: '../js/compiled.js'
      }
    },
    watch: {
      css: {
        options: {
          interrupt: true,
          livereload: true
        },
        files: ['../source/css/*.scss'],
        tasks: ['sass']
      },
      js: {
        options: {
          interrupt: true,
          livereload: true
        },
        files: ['../source/js/vendor/*.js','../source/js/*.js'],
        tasks: ['concat','uglify']
      }
    },
    copy: {
      dev: {
        files: [
          {expand: true, cwd: '../source/icons/', src: ['png/**'], dest: '../css/'},
          // {expand: true, flatten: true, cwd: '../', src: ['favicons/*'], dest: '../dev/'},
          {expand: true, cwd: '../source/', src: ['images/**/*'], dest: '../'},
          {expand: true, cwd: '../source/', src: ['js/no-concat/modernizr.js'], dest: '../'}
        ]
      }
    },
    uglify: {
      build: {
        files: {
          '../js/compiled.min.js' : '../js/compiled.js'
        }
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-grunticon');
  grunt.loadNpmTasks('grunt-includes');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  // grunt.loadNpmTasks('grunt-s3');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // grunt.loadNpmTasks('grunt-svgmin');
  // grunt.loadNpmTasks('grunt-contrib-imagemin');

  // Default task.
  grunt.registerTask('default', ['copy:dev','sass','concat','uglify']);
  grunt.registerTask('icons', ['grunticon']);
  // This is the build process for development
  // grunt.registerTask('staging', ['s3:dev']);
  // grunt.registerTask('staging-full', ['s3']);

};
