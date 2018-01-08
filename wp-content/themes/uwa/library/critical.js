var critical = require('critical');

critical.generate({
    // base: 'test/',
    // css: ['/library/css/build/minified/style.css'],
    src: 'https://uwa-gulp.dev',
    dest: 'critical/critical-home.css',
    minify: true,
    width: 1300,
    height: 900
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees',
    dest: 'critical/critical-online-degrees.css',
    minify: true,
    width: 1300,
    height: 900
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees/degree-levels/masters',
    dest: 'critical/critical-degree-levels.css',
    minify: true,
    width: 1300,
    height: 900
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees/areas-of-study/business',
    dest: 'critical/critical-areas-study.css',
    minify: true,
    width: 1300,
    height: 900
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees/m-s-guidance-counseling',
    dest: 'critical/critical-program-page.css',
    minify: true,
    width: 1300,
    height: 900
});


critical.generate({
    src: 'https://uwa-gulp.dev/tuition/tuition-information',
    dest: 'critical/critical-interior.css',
    minify: true,
    width: 1300,
    height: 900
});




//
// options: {
//     url: "http://uwa.dev/my/online-degree",
//     width: 1200,
//     height: 900,
//     outputfile: "css/build/lp-critical.css",
//     filename: "css/build/minified/lp-style.css",
//     buffer: 800*1024,
//     ignoreConsole: false
// }
