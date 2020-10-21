const $listing = $("#bookList");

$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('form#fetchBooks').submit( e => {
        e.preventDefault();

        const $form = $(e.currentTarget);

        $.ajax({
            type:'POST',
            url:'fetchBooks',
            data: {term: $form.find('input[name=term]').val()},
            success:function(results){
                const books = JSON.parse(results).items;
                appendBooks(books);
            }
        });
    });

    $('#sort li').click(function() {
        const sortDirection = $(this).data('sort');
        sortTitles(sortDirection);
    });

    $listing.on('click', 'li', function (e) {
        e.preventDefault();
        const bookInfo = $(this).data('info');
        showInfoPage(bookInfo);
    });
});

function appendBooks(books) {
    for (const book of books) {
        const info = book.volumeInfo;
        const infoJson = JSON.stringify(info);
        const bookStyle = `style="background: url(${info.imageLinks.thumbnail})"`;
        const bookItem = `<li data-title="${info.title}" data-info='${infoJson}' ${bookStyle}><a href="">${info.title}</a></li>`;
        $listing.append(bookItem);
    }
}

function sortTitles(sortDirection) {

    const $booksOnShelf = $listing.find('li');
    const bookShelfTitles = [];
    $booksOnShelf.each(function(i) {
        bookShelfTitles.push($(this).data('title'));
    });
    const sortedTitlesAsc = bookShelfTitles.sort();

    //0 = asc, 1 = desc
    if (sortDirection) {
        sortBooks(sortedTitlesAsc.reverse());
    }
    sortBooks(sortedTitlesAsc);
}

function sortBooks(sortedTitles) {
    const $booksOnShelf = $listing.find('li');
    $booksOnShelf.each(function(i) {
        const title = $(this).data('title');
        const newOrder = sortedTitles.indexOf(title);
        $(this).css('order', newOrder);
    });
}



function showInfoPage(bookInfo) {
    $('#infoPage').show();
}
