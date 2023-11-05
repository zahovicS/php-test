const path = require('path')

module.exports = {
  entry: {
    // 'public/assets/js/app': './resources/js/app.js',
    // 'public/assets/js/products/index': './resources/js/products/index.js',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname),
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader', 'postcss-loader'],
      },
    ],
  },
}
