import { Icon, Sidebar, Card, Heading } from "../../components";
import { __ } from '@wordpress/i18n';

const Homepage = () => {
    const cardLists = [
        {
            iconSvg: <Icon icon="site" />,
            heading: __('Site Identity', 'blossom-coach'),
            buttonText: __('Customize', 'blossom-coach'),
            buttonUrl: cw_dashboard.custom_logo
        },
        {
            iconSvg: <Icon icon="colorsetting" />,
            heading: __("Color Settings", 'blossom-coach'),
            buttonText: __('Customize', 'blossom-coach'),
            buttonUrl: cw_dashboard.colors
        },
        {
            iconSvg: <Icon icon="layoutsetting" />,
            heading: __("Layout Settings", 'blossom-coach'),
            buttonText: __('Customize', 'blossom-coach'),
            buttonUrl: cw_dashboard.layout
        },
        {
            iconSvg: <Icon icon="instagramsetting" />,
            heading: __("Instagram Settings", 'blossom-coach'),
            buttonText: __('Customize', 'blossom-coach'),
            buttonUrl: cw_dashboard.instagram
        },
        {
            iconSvg: <Icon icon="generalsetting" />,
            heading: __("General Settings"),
            buttonText: __('Customize', 'blossom-coach'),
            buttonUrl: cw_dashboard.general
        },
        {
            iconSvg: <Icon icon="footersetting" />,
            heading: __('Footer Settings', 'blossom-coach'),
            buttonText: __('Customize', 'blossom-coach'),
            buttonUrl: cw_dashboard.footer
        }
    ];

    const proSettings = [
        {
            heading: __('Header Layouts', 'blossom-coach'),
            para: __('Choose from different unique header layouts.', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Layouts', 'blossom-coach'),
            para: __('Choose layouts for blogs, banners, posts and more.', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Sidebar', 'blossom-coach'),
            para: __('Set different sidebars for posts and pages.', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Sticky/Floating Menu', 'blossom-coach'),
            para: __('Show a sticky/floating Menu for the site', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Boost your website performance with ease.', 'blossom-coach'),
            heading: __('Performance Settings', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('You can create a one page scrollable website.', 'blossom-coach'),
            heading: __('One Page Website', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Import the demo content to kickstart your site.', 'blossom-coach'),
            heading: __('One Click Demo Import', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Easily place ads on high conversion areas.', 'blossom-coach'),
            heading: __('Advertisement Settings', 'blossom-coach'),
            buttonText: __('Learn More', 'blossom-coach'),
            buttonUrl: cw_dashboard?.get_pro
        },
    ];

    const sidebarSettings = [
        {
            heading: __('We Value Your Feedback!', 'blossom-coach'),
            icon: "star",
            para: __("Your review helps us improve and assists others in making informed choices. Share your thoughts today!", 'blossom-coach'),
            imageurl: <Icon icon="review" />,
            buttonText: __('Leave a Review', 'blossom-coach'),
            buttonUrl: cw_dashboard.review
        },
        {
            heading: __('Knowledge Base', 'blossom-coach'),
            para: __("Need help using our theme? Visit our well-organized Knowledge Base!", 'blossom-coach'),
            imageurl: <Icon icon="documentation" />,
            buttonText: __('Explore', 'blossom-coach'),
            buttonUrl: cw_dashboard.docmentation
        },
        {
            heading: __('Need Assistance? ', 'blossom-coach'),
            para: __("If you need help or have any questions, don't hesitate to contact our support team. We're here to assist you!", 'blossom-coach'),
            imageurl: <Icon icon="supportTwo" />,
            buttonText: __('Submit a Ticket', 'blossom-coach'),
            buttonUrl: cw_dashboard.support
        }
    ];

    return (
        <>
            <div className="customizer-settings">
                <div className="cw-customizer">
                    <div className="video-section">
                        <div className="cw-settings">
                            <h2>{__('Blossom Coach Tutorial', 'blossom-coach')}</h2>
                        </div>
                        <iframe src="https://www.youtube.com/embed/d7zzIPvlAK4" title={__( 'How to Start a Coaching Website for Coaches, Speakers, Mentors & Therapists | Blossom Coach')} frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerPolicy="strict-origin-when-cross-origin" allowFullScreen></iframe>
                    </div>
                    <Heading
                        heading={__('Quick Customizer Settings', 'blossom-coach')}
                        buttonText={__('Go To Customizer', 'blossom-coach')}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={cardLists}
                        cardPlace='customizer'
                        cardCol='three-col'
                    />
                    <Heading
                        heading={__('More features with Pro version', 'blossom-coach')}
                        buttonText={__('Go To Customizer', 'blossom-coach')}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={proSettings}
                        cardPlace='cw-pro'
                        cardCol='two-col'
                    />
                    <div className="cw-button">
                        <a href={cw_dashboard?.get_pro} target="_blank" className="cw-button-btn primary-btn long-button">{__('Learn more about the Pro version', 'blossom-coach')}</a>
                    </div>
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true} />
            </div>
        </>
    );
}

export default Homepage;