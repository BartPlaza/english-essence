module.exports = {
    testRegex: 'resources/assets/js/components/.*.test.js$',
    setupTestFrameworkScriptFile: "./setupEnzyme.js",
    transform: {
        "^.+\\.js$": "babel-jest"
    },
    moduleNameMapper: {
        "\\.(css|scss)$": "<rootDir>/resources/assets/js/__mocks__/styleMock.js"
    }
}