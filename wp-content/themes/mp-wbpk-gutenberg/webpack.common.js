const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const WebpackAssetsManifest = require('webpack-assets-manifest');

const entry_points = require('./webpack-entry.json')

module.exports = {
    resolve: {
        alias: {
            Fonts: path.resolve(__dirname, 'src/fonts/'),
            Images: path.resolve(__dirname, 'src/images/'),
            JS: path.resolve(__dirname, 'src/js/'),
            SCSS: path.resolve(__dirname, 'src/scss/'),
        },
    },
    plugins: [
        new MiniCssExtractPlugin({
                filename: "[name].[contenthash].css"
            }
        ),
        new WebpackAssetsManifest({
            writeToDisk: true,
            output: "manifest.json",
            entrypoints: true,
        }),
    ],
    entry: entry_points,
    module: {
        rules: [
            {
                test: /\.(css)$/,
                use: [
                    MiniCssExtractPlugin.loader, 'css-loader'
                ]
            },
            {
                test: /\.(scss)$/,
                use: [
                    MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'
                ]
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
            },
        ]
    },
    output: {
        filename: '[name].[contenthash].js',
        path: path.resolve(__dirname, 'dist'),
        clean: true,
    },
    optimization: {
        moduleIds: 'size',
        runtimeChunk: 'single',
        splitChunks: {
            chunks: 'all',
            minSize: 1,
            cacheGroups: {
                defaultVendors: {
                    test: /[\\/]node_modules[\\/]/,
                    priority: -10,
                    reuseExistingChunk: true,
                },
                default: {
                    minChunks: 1,
                    priority: -20,
                    reuseExistingChunk: true,
                },
            },
        },
    },
};