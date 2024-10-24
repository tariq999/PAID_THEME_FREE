"use strict";

const webpack = require("webpack");
const autoprefixer = require("autoprefixer");
// const AssetsPlugin = require('assets-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const FriendlyErrorsPlugin = require("friendly-errors-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const tailwindcss = require("tailwindcss");
const path = require("path");
const fs = require("fs");

const appDirectory = fs.realpathSync(process.cwd());
function resolveApp(relativePath) {
  return path.resolve(appDirectory, relativePath);
}

const paths = {
  appBuild: resolveApp("build"),
  appGlobalStyle: resolveApp("sass/global.scss"),
  appTailwindStyle: resolveApp("sass/tailwind.scss"),
  appNodeModules: resolveApp("node_modules"),
};

module.exports = (env, argv) => {
  const DEV = argv.mode === "development";
  return {
    bail: !DEV,
    mode: DEV ? "development" : "production",
    target: "web",
    // entry: [paths.appGlobalStyle],
    entry: {
      "rsw-global": paths.appGlobalStyle,
      "rsw-tailwind": paths.appTailwindStyle,
    },
    output: {
      path: path.resolve(__dirname, "./dist"),
      filename: DEV ? "[name].bundle.js" : "[name].bundle.js",
    },
    module: {
      rules: [
        {
          test: /.s(a|c)ss$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: "css-loader",
            },
            {
              loader: "postcss-loader",
              options: {
                postcssOptions: {
                  plugins: [
                    tailwindcss("./tailwind.config.js"),
                    autoprefixer({
                      overrideBrowserslist: [">1%", "last 4 versions", "Firefox ESR", "not ie < 9"],
                    }),
                  ],
                },
              },
            },
            "sass-loader",
          ],
        },
      ],
    },
    optimization: {
      minimize: !DEV,
      minimizer: [
        new OptimizeCSSAssetsPlugin({
          cssProcessorOptions: {
            map: {
              inline: false,
              annotation: true,
            },
          },
        }),
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        // filename: "turbo-main-style.css",
        filename: "[name].css",
      }),
      new webpack.EnvironmentPlugin({
        NODE_ENV: "development", // use 'development' unless process.env.NODE_ENV is defined
        DEBUG: false,
      }),
      DEV &&
        new FriendlyErrorsPlugin({
          clearConsole: false,
        }),
    ].filter(Boolean),
    resolve: {
      extensions: [".scss"],
    },
  };
};
