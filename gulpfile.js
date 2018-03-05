const gulp = require("gulp"),
      sass = require("gulp-sass"),
      autoprefixer = require("gulp-autoprefixer");

gulp.task('main_task', () =>
  gulp.src("./public/sass/*.scss")
      .pipe(sass({
        outputStyle: "expanded"
      }))
      .pipe(autoprefixer({
        versions: ["last 3 browsers"]
      }))
      .pipe(gulp.dest("./public/css/"))
);

gulp.task("default", () =>
  gulp.watch("./public/sass/*.scss", ["main_task"])
);
