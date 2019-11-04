function File(path, file) {
    'use strict';

    const Path = require('path');
    const fs = require('fs');

    Object.defineProperty(this, 'path', {
        'get': () => {
            return `${path}${Path.sep}${file}`;
        }
    });
    Object.defineProperty(this, 'file', {'get': () => file});

}

module.exports = File;