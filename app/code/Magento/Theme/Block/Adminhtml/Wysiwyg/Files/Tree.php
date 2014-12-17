<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Theme\Block\Adminhtml\Wysiwyg\Files;

/**
 * Files tree block
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Tree extends \Magento\Backend\Block\Template
{
    /**
     * @var \Magento\Theme\Helper\Storage
     */
    protected $_storageHelper;

    /**
     * @var \Magento\Framework\Url\EncoderInterface
     */
    protected $urlEncoder;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Theme\Helper\Storage $storageHelper
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Theme\Helper\Storage $storageHelper,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        array $data = []
    ) {
        $this->_storageHelper = $storageHelper;
        $this->urlEncoder = $urlEncoder;
        parent::__construct($context, $data);
    }

    /**
     * Json source URL
     *
     * @return string
     */
    public function getTreeLoaderUrl()
    {
        return $this->getUrl('adminhtml/*/treeJson', $this->_storageHelper->getRequestParams());
    }

    /**
     * Get tree json
     *
     * @param array $data
     * @return string
     */
    public function getTreeJson($data)
    {
        return \Zend_Json::encode($data);
    }

    /**
     * Get root node name of tree
     *
     * @return string
     */
    public function getRootNodeName()
    {
        return __('Storage Root');
    }

    /**
     * Return tree node full path based on current path
     *
     * @return string
     */
    public function getTreeCurrentPath()
    {
        $treePath = '/root';
        $path = $this->_storageHelper->getSession()->getCurrentPath();
        if ($path) {
            $path = str_replace($this->_storageHelper->getStorageRoot(), '', $path);
            $relative = '';
            foreach (explode('/', $path) as $dirName) {
                if ($dirName) {
                    $relative .= '/' . $dirName;
                    $treePath .= '/' . $this->urlEncoder->encode($relative);
                }
            }
        }
        return $treePath;
    }
}