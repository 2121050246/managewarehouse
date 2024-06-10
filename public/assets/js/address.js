$(document).ready(function() {
    $('#city').change(function() {
        var cityId = $(this).val();



        if (cityId) {

            $.ajax({
                url:  '/Duan/supplier/get-districts/' + cityId,
                type: 'GET',
                success: function(response) {
                    var districts = response.data;

                    $('#district').empty().append('<option value="">Chọn quận/huyện</option>');
                    $.each(districts, function(key, district) {

                        $('#district').append('<option value="' + district.id + '"   >' + district.name + '</option>');

                    });
                    $('#district').prop('disabled', false);
                },

                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Xử lý lỗi nếu có
                }

            });
        } else {
            $('#district').empty().append('<option value="">Chọn quận/huyện</option>').prop('disabled', true);
            $('#ward').empty().append('<option value="">Chọn xã/phường</option>').prop('disabled', true);
        }
    });

    $('#district').change(function() {
        var cityId = $('#city').val();
        var districtId = $(this).val();

        if (districtId) {
            $.ajax({
                url: '/Duan/supplier/get-wards/' + cityId + '/' + districtId,
                type: 'GET',
                success: function(response) {
                    wards = response.data

                    $('#ward').empty().append('<option value="">Chọn xã/phường</option>');
                    $.each(wards, function(key, ward) {
                        $('#ward').append('<option value="' + ward.id + '">' + ward.name + '</option>');
                    });
                    $('#ward').prop('disabled', false);
                },

                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Xử lý lỗi nếu có
                }
            });
        } else {
            $('#ward').empty().append('<option value="">Chọn xã/phường</option>').prop('disabled', true);
        }
    });
});
