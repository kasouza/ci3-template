const path = require('path');
module.exports = {
	scriptsBasePath: path.resolve(__dirname, 'assets/js'),
	entryPoints: {
		app: 'app',
		pages: [
			'welcome'
		],
	},
}
