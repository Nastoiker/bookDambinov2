const sliderContainer = document.querySelector('.aboutUs');
const slideRight = document.querySelector('.left-slide');
const slideLeft = document.querySelector('.right-slide');

const slidesLength = slideRight.querySelectorAll('div').length;

let activeSlideIndex = 0

slideLeft.style.top = `-${(slidesLength - 1) * 900}px`;

const changeSlide = (direction) =>
{
    const sliderHeight = sliderContainer.clientHeight
    if (direction === 'up')
    {
        activeSlideIndex++
        if (activeSlideIndex > slidesLength - 1)
        {
            activeSlideIndex = 0;
        }
    } else if (direction === 'down')
    {
        activeSlideIndex--
        if (activeSlideIndex < 0)
        {
            activeSlideIndex = slidesLength - 1;
        }
    }

    slideRight.style.transform = `translateY(-${activeSlideIndex * sliderHeight}px)`;
    slideLeft.style.transform = `translateY(${activeSlideIndex * sliderHeight}px)`;
};

// ( function() {
//     console.log(1);
//     setTimeout(changeSlide('up'), 5000)
// }());
setInterval(() => {changeSlide('up')}, 4000)