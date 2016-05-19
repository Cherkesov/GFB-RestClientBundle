<?php
namespace GFB\RestClientBundle\Rest\Vkontakte\Method;

use GFB\RestClientBundle\ApiMethodDescriptionInterface;

class UsersGet implements ApiMethodDescriptionInterface
{
    /**
     * @inheritdoc
     */
    public function getHttpMethod()
    {
        return self::HTTP_METHOD_GET;
    }

    /**
     * @inheritdoc
     */
    public function getUri()
    {
        return 'users.get';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultParameters()
    {
        return array(
            'user_ids' => null,
            'fields' => 'photo_50,city,verified',
            'name_case' => 'nom',
        );
    }

    /**
     * @inheritdoc
     */
    public function getParametersAllowedTypes()
    {
        return array(
            'user_ids' => ['string', 'array'],
            'fields' => ['string', 'array'],
            'name_case' => ['string', 'array'],
        );
    }

    /**
     * @inheritDoc
     */
    public function getParametersAllowedValues()
    {
        return array(
            /*'fields' => [
                'photo_id',
                'verified',
                'sex',
                'bdate',
                'city',
                'country',
                'home_town',
                'has_photo',
                'photo_50',
                'photo_100',
                'photo_200_orig',
                'photo_200',
                'photo_400_orig',
                'photo_max',
                'photo_max_orig',
                'online',
                'lists',
                'domain',
                'has_mobile',
                'contacts',
                'site',
                'education',
                'universities',
                'schools',
                'status',
                'last_seen',
                'followers_count',
                'common_count',
                'occupation',
                'nickname',
                'relatives',
                'relation',
                'personal',
                'connections',
                'exports',
                'wall_comments',
                'activities',
                'interests',
                'music',
                'movies',
                'tv',
                'books',
                'games',
                'about',
                'quotes',
                'can_post',
                'can_see_all_posts',
                'can_see_audio',
                'can_write_private_message',
                'can_send_friend_request',
                'is_favorite',
                'is_hidden_from_feed',
                'timezone',
                'screen_name',
                'maiden_name',
                'crop_photo',
                'is_friend',
                'friend_status',
                'career',
                'military',
                'blacklisted',
                'blacklisted_by_me',
            ],*/
            'name_case' => ['nom', 'gen', 'dat', 'acc', 'ins', 'abl'],
        );
    }

    /**
     * @inheritdoc
     */
    public function getResultModelType()
    {
        return 'array<GFB\RestClientBundle\Rest\Vkontakte\Model\User>';
    }
}