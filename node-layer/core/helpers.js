function Helpers() {

    const fs = require('fs');
    const {promisify} = require('util');
    fs.readFile = promisify(fs.readFile);
    fs.writeFile = promisify(fs.writeFile);
    Object.defineProperty(this, 'fs', {'get': () => fs});
    Object.defineProperty(global, 'fs', {'get': () => fs});

}

module.exports = new Helpers();