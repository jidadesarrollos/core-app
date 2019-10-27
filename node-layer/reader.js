function Reader() {

    const fs = require('fs');
    let files = [];
    Object.defineProperty(this, 'files', {'get': () => files});

    this.read = (dir) => {
        let entries = fs.readdirSync(dir);
        entries.forEach((file) => {
            const isDirectory = fs.statSync(`${dir}/${file}`).isDirectory();
            console.log(1, isDirectory, file);
            files.push(file);
        });

        for (let i in files) {
            console.log(i, files[i]);
        }
    };

};

module.exports = Reader;