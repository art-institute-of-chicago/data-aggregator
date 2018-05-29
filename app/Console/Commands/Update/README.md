This directory contains commands that are migration-esque, but for one reason or another, weren't a great fit for migrations. 

 1. Commands that seem like re-usable utils, rather than one-offs.
 2. Commands that cause tests to fail, because SQLite complains.
 3. Commands that update the search index.

We are still not quite comfortable putting the latter into migrations.