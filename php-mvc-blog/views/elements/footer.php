                    </div>
                    <?php if (isset($mostPopularTags)): ?>
                        <div class="col-lg-2">
                            <?php foreach ($mostPopularTags as $mostPopularTag) : ?>
                                <ul class="breadcrumb">
                                    <li class="active">
                                        <?php echo htmlspecialchars($mostPopularTag['text']) ?>
                                        &nbsp;&nbsp;
                                        <em>
                                            #<?php echo htmlspecialchars($mostPopularTag['popularity']); ?>
                                        </em>
                                    </li>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/library/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="/library/phpLib/Paging/public/javascript/zebra_pagination.js"></script>
        <footer>
            &copy AniSoft&reg, 2015
        </footer>
    </body>
</html>
