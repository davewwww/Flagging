TechnicalDoc
------------



Model
-----

- Feature
    - FilterBag (filter)
        - FilterGroup
            - Filter
    - FilterBag (breaker)
        - FilterGroup
            - Filter
    - ValueBag
        - Value
            - value
            - FilterBag
                - FilterGroup
                    - Filter
        
            
Vote procedure
--------------

- FeatureDecider::decide( name/Feature )
    - FeatureVoter::vote( Feature )
        - FilterBagVoter::vote( FilterBag )
            - FeatureGroupsVoter::vote( FilterGroups[] )
                - EntriesAndVoter::vote( Filters[] )
                    - FilterVoter::vote( Filter )
                        - VoterManager::getVoter( name )
                        - ***Voter::vote( config )

