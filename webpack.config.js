const fs = require('fs');
const path = require('path');
const {exit} = require('process');

const scripts = require('./scripts.config');

function parseEntryPoints(entryPoints, scriptsBasePath, baseString = '') {
	const entries = {};

	for (const [entry, script] of Object.entries(entryPoints)) {
		if (typeof script == 'string') {
			entries[path.join(baseString, entry)] = path.join(scriptsBasePath, baseString, script);
			continue;
		}

		if (Array.isArray(script)) {
			for (const scriptName of script) {
				entries[path.join(baseString, entry, scriptName)] = path.join(scriptsBasePath, baseString, entry, scriptName)
			}
			continue;
		}

		if (typeof script === 'object') {
			entries.concat(parseEntryPoints(entryPoints, scriptsBasePath, path.join(baseString, entry)));
		}
	}

	return entries;
}

function parseAndValidateEntries(entryPoints, scriptsBasePath) {
	const entries = parseEntryPoints(entryPoints, scriptsBasePath);
	const extensions = [
		'',
		'.js',
	];

	for (const filename of Object.values(entries)) {
		let exists = false;
		for (const ext of extensions) {
			if (fs.existsSync(filename + ext)) {
				exists = true;
				break;
			}
		}

		if (!exists) {
			console.error('File does not exist: "' + filename + '"');
			exit(-1);
		}
	};

	return entries;
}

const entry = parseAndValidateEntries(scripts.entryPoints, scripts.scriptsBasePath)
module.exports = {
	mode: 'development',
	target: ['web', 'es5'],
	devtool: 'inline-source-map',
	entry,
	output: {
		path: path.resolve(__dirname, 'assets/dist'),
	},
	optimization: {
		splitChunks: {
			cacheGroups: {
				commons: {
					name: 'commons',
					chunks: 'initial',
					minChunks: 2,
					minSize: 0
				}
			}
		},
		//chunkIds: 'deterministic' // To keep filename consistent between different modes (for example building only)
	}
};
