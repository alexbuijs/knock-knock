const isDev = process.env.NODE_ENV === 'development'

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const StylelintPlugin = require('stylelint-webpack-plugin');

module.exports = {
    mode: isDev ? 'development' : 'production',
    entry: {
        main: [
            './assets/js/main.js',
            './assets/scss/main.scss',
        ],
        profile: [
            './assets/js/profile.jsx',
        ],
        // Separate datepicker for admin
        datepicker: [
            './assets/scss/_datepicker.scss'
        ],
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
                enforce: 'pre',
                test: /\.jsx?$/,
                exclude: /(node_modules)/,
                loader: 'eslint-loader',
                options: {
                    fix: true,
                },
            },
            {
                test: /\.m?jsx?$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                        plugins: [
                            '@babel/plugin-transform-react-jsx',
                            ["@babel/plugin-transform-runtime", {
                                "regenerator": true,
                                "corejs": 3
                            }]
                        ]
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
                            postcssOptions: {
                                plugins: [
                                    [
                                        'postcss-preset-env',
                                        {
                                        // Options
                                        },
                                    ],
                                ],
                            },
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
    resolve: {
        extensions: ['.js', '.jsx', '.css', '.scss']
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: isDev ? '[name].css' : '[name].[contenthash:8].css'
        }),
        new StylelintPlugin({
            fix: true
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