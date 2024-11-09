<script>
    $(document).ready(function() {
        $('.shopping-cart-form').on('submit',function(e){
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                url: "{{ route('cart.add_to_cart') }}",
                success: function(data){
                   if(data.status == 'success'){
                    location.reload();
                   }
                   if(data.status == 'error'){
                    toastr.error(data.message,'Error');
                   }
                },
                error: function(data){
                }
            });
        })
    })
</script>