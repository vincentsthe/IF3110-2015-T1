<!DOCTYPE HTML>
<html>
    <head>
        <title>Stack Exchange</title>

        <link rel="stylesheet" type="text/css" href="/assets/css/base.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Simple StackExchange</h1>

            <div class="row">
                <form action="/thread/search.php" action="GET">
                    <div class="span-8 span-offset-1">
                        <div class="span-8">
                            <input type="text" class="form" name="q">
                        </div>
                        <div class="span-1">
                            <button class="btn" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center">
                <p>
                    Cannot find what you are looking for? <a href="/thread/add.php">Ask Here</a>
                </p>
            </div>

            <h2>Recently Asked Question</h2>
            <?php foreach($threads as $thread): ?>
                <div class="thread">
                    <div class="row">
                        <div class="span-1">
                            <h4 class="text-center"><?= $thread["vote"] ?></h4>
                            <h4 class="text-center">Votes</h4>
                        </div>
                        <div class="span-1">
                            <h4 class="text-center"><?= $thread["answer"] ?></h4>
                            <h4 class="text-center">Answer</h4>
                        </div>
                        <div class="span-8">
                            <h3><b>
                                    <a href="/thread/view.php?id=<?= $thread["id"] ?>"><?= $thread["topic"] ?></a>
                                </b></h3>
                            <p>
                                <?= $thread["content"] ?>
                            </p>
                            <p class="text-right footer">
                                Asked by <?= $thread["author"] ?> | <a href="/thread/update.php?id=<?= $thread["id"] ?>">Edit</a> | <a onclick="deleteThread(<?= $thread["id"] ?>)">Delete</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script type="text/javascript" src="/assets/js/home.js"></script>
    </body>
</html>