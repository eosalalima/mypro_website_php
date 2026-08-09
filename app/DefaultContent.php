<?php

declare(strict_types=1);

namespace MyPro;

final class DefaultContent
{
    public static function settings(): array
    {
        return [
            'company_name' => 'Myprofessional Solutions, Inc.',
            'tagline' => 'Making IT Simple',
            'phone_primary' => '+632 9177936188',
            'phone_secondary' => '+632 9992297632',
            'email' => 'sales.myprosolinc@gmail.com',
            'website' => 'www.myprosol.com',
        ];
    }

    public static function items(): array
    {
        $items = [
            ['service', 'IT Infrastructure', 'it-infrastructure', 'Resilient foundations for connected operations.', 'Structured cabling, network connectivity, data-center infrastructure, servers, storage, power protection, and physical security—planned and delivered around your operating requirements.'],
            ['service', 'Cybersecurity', 'cybersecurity', 'Practical protection across users, networks, and data.', 'Layered solutions spanning firewalls, antivirus, security appliances, intrusion prevention, web security, email security, and managed detection capabilities.'],
            ['service', 'Computing Devices', 'computing-devices', 'The right workplace technology, ready for business.', 'Business desktops, laptops, servers, storage, printers, CCTV, UPS systems, accessories, operating systems, productivity tools, and software licensing.'],
            ['service', 'Managed Services', 'managed-services', 'Specialist support that keeps your team moving.', 'Network administration, IT helpdesk, preventive maintenance, training, technical briefings, resource deployment, and Hybrid Security Operations Center services.'],
            ['service', 'Digital Transformation', 'digital-transformation', 'Technology aligned with how your organization works.', 'Consultancy, systems integration, application development, enterprise human capital management, and sustainable solar-energy solutions.'],
            ['solution', 'Hybrid Security Operations Center', 'hybrid-soc', 'Continuous security visibility with experienced support.', 'Managed security services delivered with portfolio-listed technology partners Sophos and Secureworks.'],
            ['solution', 'Data Center Design & Build', 'data-center-design-build', 'Infrastructure engineered as one dependable environment.', 'Servers, networking, storage, redundant power, environmental controls, fire suppression, telecom, workstations, and physical security.'],
            ['solution', 'Enterprise HCM', 'enterprise-hcm', 'Bring people operations into one connected platform.', 'Enterprise human capital management software from portfolio-listed product line ZingHR.'],
            ['industry', 'Large Enterprises', 'large-enterprises', 'Scalable solutions for complex environments.', 'Consultative planning, integration, managed support, security, and enterprise infrastructure.'],
            ['industry', 'Small & Medium Businesses', 'small-medium-businesses', 'Right-sized IT for growing organizations.', 'Secure, maintainable technology without unnecessary complexity.'],
            ['industry', 'SOHO & Retail', 'soho-retail', 'Dependable tools for daily operations.', 'Computing, connectivity, software, surveillance, printing, and power solutions.'],
            ['project', 'Sample: Multi-Site Network Modernization', 'sample-network-modernization', 'Demonstration case study — awaiting client verification.', 'A representative delivery approach covering discovery, structured connectivity, security controls, rollout planning, and support. This is sample content and does not represent a named MyPro client.'],
            ['testimonial', 'Sample Testimonial', 'sample-testimonial', 'Demonstration quote — not a verified customer endorsement.', '“The team made a complex technology decision easier to understand.” Replace with a verified customer statement before publication.'],
            ['faq', 'What types of organizations does MyPro support?', 'organizations-supported', 'MyPro serves organizations across the Philippine market.', 'The portfolio identifies large enterprises, small and medium businesses, small offices/home offices, and the retail market.'],
            ['faq', 'Can MyPro combine products and services?', 'combined-solutions', 'Yes. Solutions are planned around the business need.', 'MyPro combines consultancy, systems integration, infrastructure, security, devices, software, and ongoing technical support as appropriate.'],
            ['faq', 'How do we start a consultation?', 'start-consultation', 'Tell us about your objectives and current environment.', 'Send an inquiry through the contact form. A MyPro representative can then clarify scope, priorities, and next steps.'],
        ];

        return array_map(static fn (array $item, int $index): array => [
            'type' => $item[0], 'title' => $item[1], 'slug' => $item[2],
            'summary' => $item[3], 'body' => $item[4], 'status' => 'published',
            'sort_order' => $index, 'is_featured' => in_array($item[0], ['service', 'solution'], true) ? 1 : 0,
            'meta_title' => null, 'meta_description' => null,
        ], $items, array_keys($items));
    }
}
