const isDev = process.env.NODE_ENV === 'development'

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = {
    mode: isDev ? 'development' : 'production',
    entry: [
        './assets/js/main.js'
    ],
    devtool: 'source-map',
    output: {
        filename: isDev ? '[name].js' : '[name].[contenthash].js',
        path: path.resolve(__dirname, 'dist'),
    },
    watch: isDev,
    module: {
        rules: [
            // Javascript 
            {
                test: /\.m?js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            // Sass
            {
                test: /\.scss$/,
                use: [
                    isDev ? 'style-loader' : MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true,
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                        },
                    },
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: isDev ? '[name].js' : '[name].[contenthash].css',
        }),
        new ManifestPlugin(),
        new BrowserSyncPlugin({
            open: false,
            proxy: 'localhost:8080',
            notify: {
                styles: {
                    // Place notification on the bottom to not interfere with WP admin bar
                    top: 'auto',
                    bottom: '0',
                    borderRadius: '0',
                    borderTopLeftRadius: '5px'
                }
            }
        })
    ],
}