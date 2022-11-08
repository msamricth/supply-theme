const path = require( 'path' ),
	webpack = require( 'webpack' );

module.exports = {
	context: path.resolve( __dirname, 'assets' ),
	entry: {
		main: [ './main.js' ],
	},
	output: {
		path: path.resolve( __dirname, 'assets/js' ),
		filename: '[name].bundle.js',
	},
	module: {
		  rules: [
			{
			  test: /\.m?js$/,
			  exclude: /node_modules/,
			  use: {
				loader: "babel-loader"
			  }
			}
		  ]
		},
		resolve: {
		  extensions: [".js", ".json"],
		  alias: {
			"@": path.resolve(__dirname, "/assets/scripts")
		  }
		},
	// Uncomment if jQuery support is needed
	externals: {
		jquery: 'jQuery'
	},
	plugins: [
		new webpack.ProvidePlugin( {
			$: 'jquery',
			jQuery: 'jquery',
			'window.jQuery': 'jquery',
		} ),
	]
};