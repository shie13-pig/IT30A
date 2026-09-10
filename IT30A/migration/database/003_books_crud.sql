--Books Query #1
SELECT * FROM books;

--Books Query #2 - Select books order by id ASC
SELECT * FROM books
    ORDER BY book_id ASC;

--Books Query #3 - Select books order by id DESC
SELECT * FROM books
    ORDER BY book_id DESC;

--Book Query #4 - Select book order by book title ASC
SELECT
    book_title,
    book_author,
    book_category
FROM books
ORDER BY book_title ASC;

--Book Query #5 - Select books order by book title DESC
SELECT
    book_id,
    book_title,
    book_author,
    book_category
FROM books
ORDER BY book_title DESC;

--Books Query #6 - Select books order by book author ASC
SELECT
    book_title,
    book_author,
    book_category
FROM books
ORDER BY book_author ASC;

--Books Query #7 - Select books order by book author DESC
SELECT
    book_title,
    book_author,
    book_category
FROM books
ORDER BY book_author DESC;

--Books Query #8 - Select books order by book category ASC
SELECT
    book_title,
    book_author,
    book_category
FROM books
ORDER BY book_category ASC;

--Books Query #9 - Select books order by book author DESC
SELECT
    book_title,
    book_author,
    book_category
FROM books
ORDER BY book_category DESC;

--Books Query #10 - Select books with specific id number
SELECT
    book_title,
    book_author,
    book_category
FROM books
WHERE book_id = 1
LIMIT 1;

--Books Query #11 - Update  book_title,book_author,book_category using specific id
UPDATE books
SET
    book_title = 'harry potter',
    book_author = 'J.K ROWLING',
    book_category = 'fantasy'
WHERE book_id = '1';
