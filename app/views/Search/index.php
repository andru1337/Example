<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?=PATH;?>">Главная</a></li>
                <li>Поиск по запросу "<?=h($query);?>"</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">

                <?php if(!empty($products)): ?>
                    <div class="product-one">
                        <?php $curr = \shop\App::$app->getProperty('currency'); ?>
                        <?php foreach($products as $product): ?>
                            <div class="col-md-4 product-left p-left">
                                <div class="product-main simpleCart_shelfItem">
                                    <a href="product/<?=$product->alias;?>" class="mask"><img class="img-responsive zoom-img" src="images/<?=$product->img;?>" alt="" /></a>
                                    <div class="product-bottom">
                                        <h3><?=$product->title;?></h3>

                                        <h4>
                                            <a data-id="<?=$product->id;?>" class="add-to-cart-link" href="cart/add?id=<?=$product->id;?>"><i></i></a> <span class=" item_price"><?=$curr['symbol_left'];?><?=$product->price * $curr['value'];?><?=$curr['symbol_right'];?></span>
                                            <?php if($product->old_price): ?>
                                                <small><del><?=$curr['symbol_left'];?><?=$product->old_price * $curr['value'];?><?=$curr['symbol_right'];?></del></small>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                    </div>
                <?php endif; ?>


    </div>
</div>
<!--product-end-->