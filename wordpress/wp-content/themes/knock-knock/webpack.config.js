const isDev = process.env.NODE_ENV === 'development'

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const StylelintPlugin = require('stylelint-webpack-plugin');
const purgecss = require('@fullhuman/postcss-purgecss')

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
        // Separate scripts for admin
        admin: [
            './assets/js/admin.js',
            './assets/scss/admin.scss'
        ],
    },
    devtool: isDev ? 'source-map' : false,
    output: {
        filename: isDev ? '[name].js' : '[name].[contenthash:8].js',
        path: path.resolve(__dirname, 'dist')
    },
    watch: isDev,
    optimization: {
        minimize: !isDev
    },
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
                        presets: [
                            [
                                '@babel/preset-env', {
                                    modules: false
                                }
                            ]
                        ],
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
                sideEffects: true,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {}
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
                                    require('autoprefixer'),
                                    purgecss({
                                        content: [
                                            `${path.join(__dirname, 'views')}/**/*.twig`, 
                                            `${path.join(__dirname, 'assets', 'js')}/**/*.jsx`
                                        ],
                                        safelist: {
                                            standard: [/show/, /active/],
                                            deep: [/^alert/, /^navbar/, /file/, /tooltip/,  /^d-/],
                                            greedy: [/collaps/]
                                        },
                                    }),
                                    null
                                ]
                            },
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: isDev,
                            implementation: require("sass")
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
        new WebpackManifestPlugin({
            publicPath: ''
        }),
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