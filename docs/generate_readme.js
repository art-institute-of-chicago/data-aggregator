const fs = require('fs');

const sections = [
  'preface',
  'endpoints',
  'fields'
];

const settings = `---
sidebar: auto
title: Documentation
---`;

const content = settings + sections.map((section) => {
  return '\n\n' + fs.readFileSync('./docs/.sections/' + section + '.md', 'utf8') + '\n\n';
}).join('');

fs.writeFileSync('docs/README.md', content);
