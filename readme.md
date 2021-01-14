Query books from Google Books API for your bookshelf. 

The form Ajax posts the search term to backend controller, which posts request to Google Books API using Guzzle HTTP client. On success the JSON response is parsed and the bookshelf populated. Book metadata are stored as JSON strings in list item data attributes for the click-thrus to single page book views. The sorters are custom coded to assign flex item ordering based on index of title in sorted (or reverse-sorted) array of titles.
