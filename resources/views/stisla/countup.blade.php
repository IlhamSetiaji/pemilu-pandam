<script>
    $('#countup').on('click', function(){
        $(this).hide();
        $('.counter').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({
                countNum: $this.text()
            }).animate({
                    countNum: countTo
                },

                {
                    duration: 30000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                        $('#dapil').show();
                    }

                });
        });
    });
</script>
