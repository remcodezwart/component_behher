
<div class="container">
    <h1>IndexController/index</h1>
    <div class="box">

        <?=$this->renderFeedbackMessages()?>

        <h3>What happens here ?</h3>
        <p>
            This is the homepage. As no real URL-route (like /login/register) is provided, the app uses the default
            controller and the default action, defined in application/config/config.php, by default it's
            IndexController and index()-method. So, the app will load application/controller/IndexController.php and
            run index() from that file. Easy. That index()-method (= the action) has just one line of code inside
            ($this->view->render('index/index');) that loads application/view/index/index.php, which is basically
            this text you are reading right now.
        </p>
        <?php foreach($this->component as $key => $value) {?>
            <div class="col-md-8">
                <h2><?=$value->name?></h2>
                <p><?=$value->hyperlink?></p>
                <p><?=$value->description?> <?=$value->specs?></p>
                <p>In voorraad: <?=$value->amount?></p>
                <?php if (Session::userIsLoggedIn()) : ?>
                    <form method="post" action="<?=Config::get('URL'); ?>index/loanMe">
                        <input type="hidden" name="id" value="<?=$value->id?>"/>
                        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
                        <input type="submit" class="button" value="Ik wil dit lenen."/>
                    </form>
                    <form method="post" action="<?=Config::get('URL'); ?>component/editSave">
                        <p>Verander beschrijving:<textarea name="description"><?=$value->description?></textarea></p>
                        <p>Verander specs:<textarea type="textarea" name="specs"><?=$value->specs?></textarea></p>
                        <p>Verander hyperlink:<input type="text" name="hyperlink" value="<?=$value->hyperlink?>"/></p>
                        <input type="hidden" name="id" value="<?=$value->id?>"/>
                        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
                        <input type="submit" class="button" value='Sla op'/>
                    </form>
                    <form method="post" action="<?=Config::get('URL'); ?>component/delete">
                        <input type="hidden" name="id" value="<?=$value->id?>"/>
                        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
                        <input type="submit" class="button" value='verwijder'/>
                    </form>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
</div>