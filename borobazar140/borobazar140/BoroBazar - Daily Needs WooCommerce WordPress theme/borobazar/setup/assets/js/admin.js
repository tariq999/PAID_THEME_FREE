(function ($) {
  function performAjaxRequest(
    data,
    beforeSendCallback,
    successCallback,
    errorCallback,
    completeCallback
  ) {
    $.ajax({
      url: rsw_data.ajax_url,
      type: 'POST',
      data: data,
      beforeSend: function () {
        if (beforeSendCallback) {
          beforeSendCallback();
        }
      },
      success: function (response) {
        if (successCallback) {
          successCallback(response);
        }
      },
      error: function (xhr, status, error) {
        if (errorCallback) {
          errorCallback(xhr, status, error);
        }
      },
      complete: function () {
        if (completeCallback) {
          completeCallback();
        }
      },
    });
  }

  $('.rsw-plugin-activate').on('click', function (e) {
    e.preventDefault();

    var _this = $(this);

    var type = _this.data('type');
    var slug = _this.data('slug');
    var base = _this.data('base');
    var url = _this.data('url');

    var data = {
      action: 'install_activate_plugin',
      security: rsw_data.security,
      type,
      slug,
      base,
      url,
    };

    performAjaxRequest(
      data,
      function (response) {
        _this.find('.loader').addClass('show');
      },
      function (response) {
        // Code to handle the success response

        if ('string' === typeof response) {
          var jsonStart = response.indexOf('{');
          var jsonPart = response.substr(jsonStart);
          try {
            var jsonResponse = JSON.parse(jsonPart);
            if (jsonResponse.success) {
              _this
                .addClass('activated')
                .prop('disabled', true)
                .text('Installed');
              _this.find('.loader').removeClass('show');
            }
          } catch (error) {
            console.log('Error parsing JSON:', error);
          }
        } else if ('object' === typeof response) {
          if (response.success) {
            _this
              .addClass('activated')
              .prop('disabled', true)
              .text('Installed');
            _this.find('.loader').removeClass('show');
          }
        }
      },
      function (xhr, status, error) {
        // Code to handle the error response
        console.log(error);
      }
    );
  });

  $('.license-activation-form').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
    var values = _this.serialize();
    var params = new URLSearchParams(values);

    var licenseKey = params.get('license_key');
    var deactivate = params.get('deactivate');

    var data = {
      action: 'activate_license_key',
      security: rsw_data.security,
      licenseKey,
    };

    if (deactivate !== null) {
      data.deactivate = deactivate;
    }

    performAjaxRequest(
      data,
      function (response) {
        $('.purchase-invalid').remove();
        _this.find('button .loader').addClass('show');
      },
      function (response) {
        var loader = $(
          `<span class="loader w-4 h-4 hidden rounded-full border-2 border-r-white border-l-white border-t-white border-b-transparent animate-spin ms-3"></span>`
        );
        console.log(response.data);
        if (response.success && response.data.type == 'activation_success') {
          var masked_length = Math.max(licenseKey.length - 16, 0);
          var masked_code =
            licenseKey.substr(0, 6) +
            '*'.repeat(masked_length) +
            licenseKey.substr(-6);
          $('.license-activation-form .license-key').val(licenseKey).attr('readonly',true);
          $('.license-activation-form button').text(response.data.btn_text);
          $('.license-activation-form button').append(loader);
          $('.redq-setup-wizard-activation-form h2 span')
            .removeClass('text-red-500')
            .addClass('text-[#36B779]')
            .text(response.data.status);
          let deactivateType = $(
            `<input type="hidden" name="deactivate" value="1">`
          );
          $('.license-activation-form').append(deactivateType);
          let href = $('.redq-setup-wizard-navigation .next').attr('href');
          $('.redq-setup-wizard-navigation .next')
            .attr('href', `${href}&next=1`)
            .removeClass('disabled');
          _this.find('button .loader').removeClass('show');
        }
        if (!response.success) {
          $(
            '.redq-setup-wizard-activation-form .license-activation-form'
          ).before(
            '<span class="purchase-invalid">' +
              response.data.message +
              '</span>'
          );
          _this.find('button .loader').removeClass('show');
        }
        if (response.success && response.data.type == 'deactivation_success') {
          $('.license-activation-form button').text(response.data.btn_text);
          $('.license-activation-form button').append(loader);
          $('.redq-setup-wizard-activation-form h2 span')
            .removeClass('text-[#36B779]')
            .addClass('text-red-500')
            .text(response.data.status);
          $('.license-activation-form .license-key').attr('readonly',false);
          $('.license-activation-form input[type="hidden"]').remove();
          let href = $('.redq-setup-wizard-navigation .next').attr('href');
          href = href.replace(/(\?|&)next=1/, '');
          $('.redq-setup-wizard-navigation .next')
            .attr('href', href)
            .addClass('disabled');
          _this.find('button .loader').removeClass('show');
        }
      },
      function (xhr, status, error) {
        console.log(error);
      }
    );
  });

  function installAllPlugins(index, _this) {
    var plugins = rsw_data.plugins;
    if (!_this.find('.loader').hasClass('show')) {
      _this.find('.loader').addClass('show');
    }
    if (index >= plugins.length) {
      _this.find('.loader').removeClass('show');
      _this
        .addClass('activated')
        .prop('disabled', true)
        .text('Installed All Plugins');
      return;
    }

    let type = plugins[index].source ? 'self' : 'wporg';
    let slug = plugins[index].slug;
    let base = plugins[index].base;
    let url = plugins[index].source;

    var _plugin = $(
      '.redq-setup-wizard-plugins ul li button[data-slug="' + slug + '"]'
    );
    if (_plugin.hasClass('activated')) {
      installAllPlugins(index + 1, _this);
      return;
    }

    var data = {
      action: 'install_activate_plugin',
      security: rsw_data.security,
      type,
      slug,
      base,
      url,
    };

    performAjaxRequest(
      data,
      function (response) {
        _plugin.find('.loader').addClass('show');
      },
      function (response) {
        if ('string' === typeof response) {
          var jsonStart = response.indexOf('{');
          var jsonPart = response.substr(jsonStart);
          try {
            var jsonResponse = JSON.parse(jsonPart);
            if (jsonResponse.success) {
              _plugin
                .addClass('activated')
                .prop('disabled', true)
                .text('Installed');
              _plugin.find('.loader').removeClass('show');
              installAllPlugins(index + 1, _this);
            } else {
              console.log('Error:', jsonResponse.data);
            }
          } catch (error) {
            console.log('Error parsing JSON:', error);
          }
        } else if ('object' === typeof response) {
          if (response.success) {
            _plugin
              .addClass('activated')
              .prop('disabled', true)
              .text('Installed');
            _plugin.find('.loader').removeClass('show');
            installAllPlugins(index + 1, _this);
          } else {
            console.log('Error:', response.data);
          }
        }
      },
      function (xhr, status, error) {
        console.log(error);
      }
    );
  }

  $('.rsw-plugin-activate-all').on('click', function (e) {
    e.preventDefault();
    var _this = $(this);
    installAllPlugins(0, _this);
  });

  $('.rsw-child-theme-activate').on('click', function (e) {
    e.preventDefault();
    var _this = $(this);

    var data = {
      action: 'install_activate_child_theme',
      security: rsw_data.security,
    };

    performAjaxRequest(
      data,
      function (response) {
        _this.find('.loader').addClass('show');
      },
      function (response) {
        if ('string' === typeof response) {
          var jsonStart = response.indexOf('{');
          var jsonPart = response.substr(jsonStart);
          try {
            var jsonResponse = JSON.parse(jsonPart);
            if (jsonResponse.success) {
              _this.prop('disabled', true);
              _this.find('.loader').removeClass('show');
              _this.next('span').text(jsonResponse.data);
            }
          } catch (error) {
            console.log('Error parsing JSON:', error);
          }
        } else if ('object' === typeof response) {
          if (response.success) {
            _this.find('.loader').removeClass('show');
            _this.next('span').text(response.data);
          }
        }
      },
      function (xhr, status, error) {
        // Code to handle the error response
        console.log(error);
      }
    );
  });

  function ajaxCall(data, $button) {
    // AJAX call to import everything (content, widgets, before/after setup)
    $.ajax({
      method: 'POST',
      url: rsw_data.ajax_url,
      data: data,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $button
          .parent()
          .parent()
          .parent()
          .find('.ocdi__gl-item-image-container img')
          .hide();
        $button
          .parent()
          .parent()
          .parent()
          .find('.ocdi__gl-item-image-container .loader-container')
          .addClass('show');
      },
    })
      .done(function (response) {
        if (
          'undefined' !== typeof response.status &&
          'newAJAX' === response.status
        ) {
          ajaxCall(data, $button);
        } else if (
          'undefined' !== typeof response.status &&
          'customizerAJAX' === response.status
        ) {
          // Fix for data.set and data.delete, which they are not supported in some browsers.
          var newData = new FormData();
          newData.append('action', 'ocdi_import_customizer_data');
          newData.append('security', rsw_data.ocdi_security);

          // Set the wp_customize=on only if the plugin filter is set to true.
          if (true === rsw_data.wp_customize_on) {
            newData.append('wp_customize', 'on');
          }

          ajaxCall(newData, $button);
        } else if (
          'undefined' !== typeof response.status &&
          'afterAllImportAJAX' === response.status
        ) {
          // Fix for data.set and data.delete, which they are not supported in some browsers.
          var newData = new FormData();
          newData.append('action', 'ocdi_after_import_data');
          newData.append('security', rsw_data.ocdi_security);
          ajaxCall(newData, $button);
        } else if ('undefined' !== typeof response.message) {
          if ('Import Complete!' === response?.title) {
            $button
              .parent()
              .parent()
              .parent()
              .find('.ocdi__gl-item-image-container img')
              .attr('src', rsw_data.success_image)
              .css({ height: '60%', margin: '35px auto' })
              .show();
            $button
              .parent()
              .parent()
              .parent()
              .find('.ocdi__gl-item-image-container .loader-container')
              .removeClass('show');
            $button
              .parent()
              .parent()
              .parent()
              .find('.ocdi__gl-item-image-container .ocdi__gl-item-buttons')
              .remove();

            var other_demos = $(
              '.ocdi__gl-item-container .ocdi__gl-item .ocdi__gl-item-buttons a:nth-child(2)'
            );

            other_demos.each(function () {
              var $btn = $(this);
              if (!$btn.hasClass('disabled')) {
                $btn.addClass('disabled');
              }
            });
          } else {
            console.log('error', response);
          }
        } else {
          console.log('error', response);
        }
      })
      .fail(function (error) {
        console.log('ajax error,', error);
      });
  }

  /**
   * Install demo content
   */
  $('.rsw-import-demo-content').on('click', function (event) {
    event.preventDefault();

    var $button = $(this);

    if ($button.hasClass('disabled')) {
      return false;
    }

    $button.addClass('disabled');

    var demo = $button.data('demo');

    // Prepare data for the AJAX call
    var data = new FormData();
    data.append('action', 'ocdi_import_demo_data');
    data.append('security', rsw_data.ocdi_security);

    if (demo) {
      data.append('selected', demo);
    }

    ajaxCall(data, $button);
  });

  $('.rsw-set-permalink').click(function (e) {
    e.preventDefault();
    var _this = $(this);
    var newStructure = '/%postname%/';
    $.ajax({
      type: 'POST',
      url: rsw_data.ajax_url,
      data: {
        action: 'change_permalink_structure',
        new_structure: newStructure,
      },
      beforeSend: function () {
        _this.find('.loader').addClass('show');
      },
      success: function (response) {
        if (response.success) {
          $('.permalink-status').html(response.data.html);
          _this.hide();
        }
      },
      complete: function (data) {
        _this.find('.loader').removeClass('show');
      },
    });
  });
})(jQuery);
