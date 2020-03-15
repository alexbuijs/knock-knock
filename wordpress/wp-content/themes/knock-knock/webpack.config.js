const isDev = process.env.NODE_ENV === 'development'

const path = require('path');
const autoprefixer = require("autoprefixer");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = {
    mode: isDev ? 'development' : 'production',
    entry: {
        main: [
            './assets/js/main.js',
            './assets/scss/main.scss',
        ],
        // Separate datepicker for admin
        datepicker: [
            './assets/scss/_datepicker.scss'
        ]
    },
    devtool: isDev ? 'source-map' : false,
    output: {
        filename: isDev ? '[name].js' : '[name].[contenthash:8].js',
        path: path.resolve(__dirname, 'dist')
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
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            
                            hmr: isDev
                        },
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: isDev,
                        },
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            sourceMap: isDev,
                            plugins: () => [autoprefixer]
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: isDev,
                        },
                    },
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: isDev ? '[name].css' : '[name].[contenthash:8].css'
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