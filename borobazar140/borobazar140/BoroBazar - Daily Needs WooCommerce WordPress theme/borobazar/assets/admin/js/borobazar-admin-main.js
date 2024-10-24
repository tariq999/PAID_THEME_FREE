(function ($) {
	("use strict");

	var accordion = document.getElementsByClassName(
		'borobazar-getting-started-faq-header'
	);

	for (var i = 0; i < accordion.length; i++) {
		accordion[i].addEventListener('click', function (event) {
			accordionClick(event);
		});
	}

	var accordionClick = (event) => {
		var targetClicked = event.target;
		var classClicked = targetClicked.classList;
		while (classClicked[0] != 'borobazar-getting-started-faq-header') {
			targetClicked = targetClicked.parentElement;
			classClicked = targetClicked.classList;
		}
		var faqContent = targetClicked.nextElementSibling;
		if (faqContent.style.maxHeight) {
			faqContent.style.maxHeight = null;
			targetClicked.classList.remove('active');
		} else {
			var allFaqContent = document.getElementsByClassName(
				'borobazar-getting-started-faq-content'
			);
			for (var i = 0; i < allFaqContent.length; i++) {
				if (allFaqContent[i].style.maxHeight) {
					allFaqContent[i].style.maxHeight = null;
					allFaqContent[i].previousElementSibling.classList.remove('active');
				}
			}
			faqContent.style.maxHeight = faqContent.scrollHeight + 'px';
			targetClicked.classList.add('active');
		}
	};
})(jQuery);
