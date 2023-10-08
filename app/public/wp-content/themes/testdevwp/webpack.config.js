// const MiniCssExtractPlugin = require('mini-css-extract-plugin')
// const CSSMinimizerWebpackPlugin = require('css-minimizer-webpack-plugin')
const TerserJSPlugin = require('terser-webpack-plugin')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
// const sass = require('sass')
// const WebpackIconfontPluginNodejs = require('webpack-iconfont-plugin-nodejs')
// const { VueLoaderPlugin } = require('vue-loader')
const path = require('path')
const dir = 'src/'

module.exports = (env, argv) => {
  return {
    entry: {
      bundle: ['./src/index.js'],
      admin: ['./src/index-admin.js'],
      // bootstrap: ['./src/bootstrap.js', './src/bootstrap.scss'],
      // print: './src/print.scss',
      // blocks: ['./src/blocks.scss', './src/blocks.js'],
      // interaction: './src/interaction.js',
      // gutenberg: './src/gutenberg.scss',
    },
    output: {
      path: path.resolve(__dirname, 'dist'),
      publicPath: '/wp-content/themes/testdevwp/dist/',
      filename: '[name].js',
      chunkFormat: 'module',
    },
    optimization: {
      minimizer: [new TerserJSPlugin()],
    },
    plugins: [
      new CleanWebpackPlugin({
        cleanAfterEveryBuildPatterns: ['!fonts/**/*'],
      }),
      //   new MiniCssExtractPlugin(),
      //   new WebpackIconfontPluginNodejs({
      //     fontName: 'nrj-icons',
      //     cssPrefix: 'nrj-icons',
      //     svgs: path.join(dir, 'svg/*.svg'),
      //     template: 'scss',
      //     fontsOutput: path.join(dir, 'icons/'),
      //     cssOutput: path.join(dir, 'icons/icons.css'),
      //     htmlOutput: path.join(dir, 'icons/icons-preview.html'),
      //     jsOutput: path.join(dir, 'icons/icons.js'),
      //   }),
      //   new VueLoaderPlugin(),
    ],
    devtool: argv.mode === 'development' ? 'cheap-module-source-map' : 'source-map',
    mode: 'development',
    resolve: {
      extensions: ['.js'],
    },
    module: {
      rules: [
        // { test: /\.vue$/, loader: 'vue-loader' },
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              plugins: ['@babel/plugin-proposal-class-properties'],
              presets: ['@babel/preset-env'],
            },
          },
        },
        // {
        //   test: /\.(sa|sc|c)ss$/,
        //   use: [
        //     // 'vue-style-loader',
        //     MiniCssExtractPlugin.loader,
        //     'css-loader',
        //     {
        //       loader: 'postcss-loader',
        //       options: {
        //         sourceMap: true,
        //       },
        //     },
        //     'resolve-url-loader',
        //     {
        //       loader: 'sass-loader',
        //       options: {
        //         implementation: sass,
        //         // sassOptions: {
        //         //   indentedSyntax: true,
        //         // },
        //       },
        //     },
        //     {
        //       loader: 'sass-resources-loader',
        //       options: {
        //         resources: ['./src/scss/_variables.scss', './src/scss/_mixins.scss', './src/scss/_bootstrap.scss'],
        //       },
        //     },
        //   ],
        // },
        // {
        //   test: /\.(ttf|eot|woff|woff2|svg)$/,
        //   exclude: path.resolve(__dirname, 'src/svg'),
        //   type: 'asset/resource',
        //   generator: {
        //     filename: 'fonts/[name].[hash][ext]',
        //   },
        // },
        // {
        //   test: /\.(png|jpe?g|gif|svg)$/i,
        //   exclude: [path.resolve(__dirname, 'src/fonts'), path.resolve(__dirname, 'src/icons')],
        //   type: 'asset/resource',
        //   generator: {
        //     filename: 'img/[hash][ext]',
        //   },
        // },
      ],
    },
    externals: {
      jquery: 'jQuery',
      wp: 'wp'
    },
  }
}
