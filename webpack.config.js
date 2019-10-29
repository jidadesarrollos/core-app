const path = require('path');

const config = {
    entry: './htdocs/modules/jsx/first.jsx',
    output: {
        'path': path.resolve(__dirname, 'htdocs/dist/js'),
        'filename': 'bundle.js'

    },
    devtool: "source-map",
    optimization: {
        minimize: false,
        splitChunks: {
            chunks: 'all'
        }
    },
    module: {
        'rules': [
            {
                'test': /\.(js|jsx)$/,
                'exclude': /(node_modules|bower_components)/,
                'use': {
                    'loader': 'babel-loader'
                }
            }
        ]
    }
};

module.exports = config;