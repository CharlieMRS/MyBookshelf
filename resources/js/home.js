const $home = $("#home");
const $listing = $("#bookList");
const $bookInfo = $("#bookInfo");

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

    $('#sort li').click(function(e) {
        e.preventDefault();
        const sortDirection = $(this).data('sort');
        sortTitles(sortDirection);
    });

    $listing.on('click', 'a', function (e) {
        e.preventDefault();
        const bookInfo = $(this).parent('li').data('info');
        showInfoPage(bookInfo);
    }).on('click', '.close', function () {
        $(this).closest('li').remove();
    });

    $('h1 a').click( e => {
        e.preventDefault();
        $home.removeClass('hide');
        $bookInfo.addClass('hide');
    });
});

function appendBooks(books) {
    $listing.html('');
    const closeButton = '<button type="button" class="close"><span aria-hidden="true">&times;</span></button>';
    for (const book of books) {
        const info = book.volumeInfo;
        const infoJson = JSON.stringify(info).replace(/'/g, "");
        const bookStyle = `style="background: url(${info.imageLinks.thumbnail})"`;
        const bookItem = `<li data-title="${info.title}" data-info='${infoJson}' ${bookStyle}><a href="">${info.title}</a>${closeButton}</li>`;
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
    $home.addClass('hide');
    $bookInfo.removeClass('hide');

    const $bookInfoTable = $bookInfo.find('table');
    $bookInfoTable.html('');
    $.each(bookInfo, function (index, value) {
        //todo: deal w/ objects too
        if (typeof value === 'string') {
            const row = `<tr><td>${index}</td><td>${value}</td></tr>`;
            $bookInfoTable.append(row);
        }
    });
}
