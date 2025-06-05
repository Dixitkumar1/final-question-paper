
<style>
    #main-header{
        height:50vh;
    }
</style>
<section class="py-4">
    <div class="container">
        <div class="card card-outline card-primary rounded-0 shadow">
            <div class="card-body">
                <?= file_get_contents('home.html') ?>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#search-frm').submit(function(e){
            e.preventDefault();
            location.href = "./?"+$(this).serialize()
        })
    })

</script>