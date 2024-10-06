<script src="{{ asset('/') }}assets/frontend/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="{{ asset('/') }}assets/frontend/js/bootstrap.min.js"></script>
<script src="{{ asset('/') }}assets/frontend/js/slick.js"></script>
<script src="{{ asset('/') }}assets/frontend/js/moment.js"></script>
<script src="{{ asset('/') }}assets/frontend/js/toast.min.js"></script>
<script src="{{ asset('/') }}assets/frontend/js/Font-Awesome.js"></script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
{{-- <x:notify-messages /> --}}
@notifyJs
@stack('js')
<script src="{{ asset('/') }}assets/frontend/js/main.js"></script>
<input type="hidden" value="{{ route('product.advance-search') }}" id="aurl" name="">
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,bn',
            autoDisplay: false,
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }

    function foo() {
        $("option[value='en']").text("عربى (Arabic)");
        $("option[value='fr']").text("Français (French)");
        //.... so on
    }
    const texts = [
    "{!! setting('placeholder_one') !!}", 
    "{!! setting('placeholder_two') !!}", 
    "{!! setting('placeholder_three') !!}", 
    "{!! setting('placeholder_four') !!}"
];
const input = document.querySelector('#searchbox');
const animationWorker = function(input, texts) {
    this.input = input;
    this.fixedText = "Search for"; // Fixed text before the animated part
    this.defaultPlaceholder = this.input.getAttribute('placeholder');
    this.texts = texts;
    this.curTextNum = 0;
    this.curPlaceholder = '';
    this.blinkCounter = 0;
    this.animationFrameId = 0;
    this.animationActive = false;
    this.input.setAttribute('placeholder', this.curPlaceholder);

    this.switch = timeout => {
        this.input.classList.add('imitatefocus');
        setTimeout(
            () => {
                this.input.classList.remove('imitatefocus');
                if (this.curTextNum == 0)
                    this.input.setAttribute('placeholder', this.defaultPlaceholder);
                else
                    this.input.setAttribute('placeholder', this.fixedText + this.curPlaceholder);

                setTimeout(
                    () => {
                        this.input.setAttribute('placeholder', this.fixedText + this.curPlaceholder);
                        if (this.animationActive)
                            this.animationFrameId = window.requestAnimationFrame(this.animate);
                    },
                    timeout);
            },
            timeout);
    };

    this.animate = () => {
        if (!this.animationActive) return;
        let curPlaceholderFullText = this.texts[this.curTextNum];
        let timeout = 150;
        
        if (this.curPlaceholder.length < curPlaceholderFullText.length) {
            // Progressively add letters one by one
            this.curPlaceholder = curPlaceholderFullText.substring(0, this.curPlaceholder.length + 1);
        } else {
            // Once the text is fully displayed, switch to the next text after a pause
            timeout = 2000;
            this.curPlaceholder = ''; // Reset to start animating the next text
            this.curTextNum = this.curTextNum >= this.texts.length - 1 ? 0 : this.curTextNum + 1;
        }

        this.input.setAttribute('placeholder', `${this.fixedText} ${this.curPlaceholder}`);
        
        // Apply bold formatting
        input.style.fontWeight = '400';
        
        setTimeout(
            () => {
                if (this.animationActive) this.animationFrameId = window.requestAnimationFrame(this.animate);
            },
            timeout);
    };

    this.stop = () => {
        this.animationActive = false;
        window.cancelAnimationFrame(this.animationFrameId);
    };

    this.start = () => {
        this.animationActive = true;
        this.animationFrameId = window.requestAnimationFrame(this.animate);
        return this;
    };
};

// To start the animation
const worker = new animationWorker(input, texts);
worker.start();



    document.addEventListener("DOMContentLoaded", () => {
        let aw = new animationWorker(input, texts).start();
        input.addEventListener("focus", e => aw.stop());
        input.addEventListener("blur", e => {
            aw = new animationWorker(input, texts);
            if (e.target.value == '') setTimeout(aw.start, 1000);
        });
    });

    setInterval(function() {
        $('.notify').hide();
    }, 5000);
    $(document).on('keyup', '#keyword', function(e) {
        let key = $(this).val();
        let url = $('#aurl').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                'key': key,
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: "JSON",
            success: function(response) {

                $("#search-view").html(response);
            },
            error: function(xhr) {
                console.log(xhr.statusText);
            }
        });
    });
</script>
<!-- GLOBAL JS/ INTERNAL JS _@stack('internal_js') -->
<script type="text/javascript">
    @php
        echo setting('global_js');
    @endphp
    @stack('internal_js')
</script>
