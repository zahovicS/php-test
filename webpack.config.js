const path = require('path')

module.exports = {
  entry: {
    // 'public/assets/hotel/js/app': './resources/js/hotel/app.js',
    // 'public/assets/hotel/js/auth/login': './resources/js/hotel/auth/login.js',
    // 'public/assets/hotel/js/auth/register': './resources/js/hotel/auth/register.js',
    // 'public/assets/hotel/js/perfil/perfil': './resources/js/hotel/perfil/perfil.js',
  },
  resolve: {
    extensions: ['.js', '.jsx', '.ts', '.tsx'],
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
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
    ],
  },
}
