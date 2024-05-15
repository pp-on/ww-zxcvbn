const path = require('path');

module.exports = {
    entry: './src/zxcvbn.ts',
    output: {
        filename: 'ww-zxcvbn.js', // Output filename
        path: path.resolve(__dirname, 'dist'), // Output directory path
    },
    resolve: {
        extensions: ['.ts', '.js'],
    },
    module: {
        rules: [
            {
                test: /\.ts$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            },
        ],
    },
};
