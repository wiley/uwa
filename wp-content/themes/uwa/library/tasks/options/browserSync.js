module.exports = {
 dev : {
        bsFiles: {
            src: [
                "css/build/minified/*.css",
                "scss/**/*.scss",
                "scss/style.scss",
            ],
        },
        options: {
						proxy: "uwa.loc"
        }
    }
}
