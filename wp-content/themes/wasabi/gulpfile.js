const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const sourcemaps = require("gulp-sourcemaps");


// SCSS をコンパイルするタスク
function compileSass() {
  return gulp.src("./assets/scss/*.scss")
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "expanded" }).on("error", sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest("./assets/css"));
}


// SCSS の変更を監視するタスク
function watchFiles() {
  gulp.watch("./assets/scss/**/*.scss", compileSass);
}

exports.default = gulp.series(compileSass, watchFiles);
exports.build = compileSass;