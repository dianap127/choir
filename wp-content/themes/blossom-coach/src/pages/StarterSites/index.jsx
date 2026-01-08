import { Icon, Card } from "../../components";
import { __ } from "@wordpress/i18n";
import { mainDemo, demo2, demo3, demo4, demo5, demo6, demo7, demo8, } from "../../components/images";

const StarterSites = () => {
    const cardList = [
        {
            heading: __('Default', 'blossom-coach'),
            imageurl: mainDemo,
            buttonUrl: __('https://blossomthemesdemo.com/blossom-coach-pro/', 'blossom-coach'),
        },
        {
            heading: __('Life Coach (Elementor)', 'blossom-coach'),
            imageurl: demo2,
            buttonUrl: __('https://blossomthemesdemo.com/coach-pro-life-coach/', 'blossom-coach'),
        },
        {
            heading: __('Wellness Coach (Elementor)', 'blossom-coach'),
            imageurl: demo3,
            buttonUrl: __('https://blossomthemesdemo.com/coach-pro-wellness/', 'blossom-coach'),
        },
        {
            heading: __('Health Coach', 'blossom-coach'),
            imageurl: demo4,
            buttonUrl: __('https://blossomthemesdemo.com/coach-pro-health/', 'blossom-coach'),
        },
        {
            heading: __('Life Coach', 'blossom-coach'),
            imageurl: demo5,
            buttonUrl: __('https://blossomthemesdemo.com/coach-pro-life/', 'blossom-coach'),
        },
        {
            heading: __('Speaker', 'blossom-coach'),
            imageurl: demo6,
            buttonUrl: __('https://blossomthemesdemo.com/coach-pro-speaker/', 'blossom-coach'),
        },
        {
            heading: __('Marriage Coach', 'blossom-coach'),
            imageurl: demo7,
            buttonUrl: __('https://blossomthemesdemo.com/coach-pro-marriage/', 'blossom-coach'),
        },
        {
            heading: __('Fitness Coach', 'blossom-coach'),
            imageurl: demo8,
            buttonUrl: __('https://blossomthemesdemo.com/coach-pro-fitness/', 'blossom-coach'),
        },

    ]
    return (
        <>
            <Card
                cardList={cardList}
                cardPlace='starter'
                cardCol='three-col'
            />
            <div className="starter-sites-button cw-button">
                <a href={__('https://blossomthemes.com/theme-demo/?theme=blossom-coach-pro&utm_source=blossom-coach&utm_medium=dashboard&utm_campaign=theme_demo', 'blossom-coach')} target="_blank" className="cw-button-btn outline">
                    {__('View All Demos', 'blossom-coach')}
                    <Icon icon="arrowtwo" />
                </a>
            </div>
        </>
    );
}

export default StarterSites;