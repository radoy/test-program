# README
=====================================================================

### SQL Improvement Logic Test

### Suggestion
1. Change 'publish_status = 1' to 'Jobs.publish_status = 1'.
2. Set up MySQL query cache.
3. Implement full-text indexing for all columns that use in Wildcard string search.
4. Can we do a leading string search, instead of a wildcard search? Can '%キャビンアテンダント%' be changed to 'キャビンアテンダント%'? 
5. Set index on 'Jobs.sort_order' column
6. Reduce the limit lower than 50