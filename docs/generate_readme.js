const fs = require('fs');

let sections = [
  'preface',
];

if (process.argv[2] && process.argv[2] === '--full') {
  sections.push('endpoints', 'fields');
}

const settings = `---
sidebar: auto
title: Documentation
---`;

const content = settings + sections.map((section) => {
  return '\n\n' + fs.readFileSync('./docs/.sections/' + section + '.md', 'utf8') + '\n\n';
}).join('');

fs.writeFileSync('docs/README.md', content);
