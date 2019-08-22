<?php $this->setSiteTitle("DETAILS")?>
<?php $this->start('body');?>
<div class="container">
    <div class="row">
        <a href="/contacts" class="btn btn-xs btn-default">Back</a>
    </div>
    <div class="row">
        <h2 class="text-center"><?= $this->contact->fname.' '.$this->contact->lname;?></h2>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><span class="text-bold">Email: </span><?= $this->contact->email ?></p>
            <p><span class="text-bold">Cell Phone: </span> <?= $this->contact->cell_phone ?></p>
            <p><span class="text-bold">Home Phone: </span><?= $this->contact->home_phone?></p>
            <p><span class="text-bold">Work Phone: </span><?= $this->contact->word_phone ?></p>
        </div>
        <div class="col-md-6">
            <p><span class="text-bold">State : </span><?= $this->contact->state ?></p>
            <p><span class="text-bold">City: </span> <?= $this->contact->city ?></p>
            <p><span class="text-bold">Adress: </span><?= $this->contact->adres1?></p>
        </div>
    </div>
</div>
<?php $this->end(); ?>
